<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminRoomController extends Controller
{
    public function index()
    {
        $rooms = Room::orderBy('name')->paginate(4);  // 4 rooms per page

        // Get total rooms count
        $totalRooms = Room::count();

        // Get bookings for calendar - group by date with unique room count
        $allBookings = \App\Models\Booking::whereIn('status', ['approved', 'pending'])
            ->get()
            ->groupBy(function ($booking) {
                return $booking->booking_date->format('Y-m-d');
            })
            ->map(function ($bookings) {
                return [
                    'count' => $bookings->count(),
                    'rooms_booked' => $bookings->unique('room_id')->count(),
                    'approved_count' => $bookings->where('status', 'approved')->count()
                ];
            });

        // Get closures for calendar
        $allClosures = \App\Models\RoomClosure::where('closure_date', '>=', now()->toDateString())
            ->get()
            ->groupBy(function ($closure) {
                return $closure->closure_date->format('Y-m-d');
            })
            ->map(function ($closures) {
                $allRoomsClosed = $closures->contains(function ($c) {
                    return is_null($c->room_id) && is_null($c->start_time) && is_null($c->end_time);
                });
                return [
                    'all_rooms_closed' => $allRoomsClosed,
                    'has_closures' => $closures->count() > 0,
                    'count' => $closures->count()
                ];
            });

        return view('admin.rooms.index', compact('rooms', 'allBookings', 'totalRooms', 'allClosures'));
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|array',
            'description' => 'nullable|string',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Set default values
        $validated['floor'] = 'Lantai 1'; // Default floor
        $validated['is_available'] = true;

        // Handle multiple images upload (up to 3) - filter out empty inputs
        $uploadedImages = [];
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $imageFile) {
                if ($imageFile && $imageFile->isValid()) {
                    if (count($uploadedImages) >= 3)
                        break;
                    $uploadedImages[] = $imageFile->store('rooms', 'public');
                }
            }
        }

        // First image is the profile image
        if (count($uploadedImages) > 0) {
            $validated['image'] = $uploadedImages[0];
        }
        $validated['images'] = $uploadedImages;

        Room::create($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil ditambahkan');
    }

    public function edit(Room $room)
    {
        // Get bookings for this room to show in calendar
        $bookings = \App\Models\Booking::where('room_id', $room->id)
            ->whereIn('status', ['approved', 'pending'])
            ->get()
            ->map(function ($booking) {
                return [
                    'booking_date' => $booking->booking_date->format('Y-m-d'),
                    'status' => $booking->status,
                    'start_time' => $booking->start_time,
                    'end_time' => $booking->end_time,
                ];
            });

        // Get closures for this room (including all-room closures)
        $closures = \App\Models\RoomClosure::where(function ($q) use ($room) {
            $q->whereNull('room_id') // all rooms closed
                ->orWhere('room_id', $room->id);
        })
            ->where('closure_date', '>=', now()->toDateString())
            ->get()
            ->groupBy(function ($closure) {
                return $closure->closure_date->format('Y-m-d');
            })
            ->map(function ($closures) {
                $isWholeDayClosed = $closures->contains(function ($c) {
                    return is_null($c->start_time) && is_null($c->end_time);
                });
                return [
                    'is_whole_day_closed' => $isWholeDayClosed,
                    'has_closures' => $closures->count() > 0,
                    'count' => $closures->count()
                ];
            });

        return view('admin.rooms.edit', compact('room', 'bookings', 'closures'));
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'capacity' => 'required|integer|min:1',
            'facilities' => 'nullable|array',
            'description' => 'nullable|string',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'delete_images' => 'nullable|array',
        ]);

        // Get existing images (also check legacy 'image' field)
        $existingImages = $room->images ?? [];

        // If images array is empty but single image exists, use that
        if (empty($existingImages) && $room->image) {
            $existingImages = [$room->image];
        }

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageToDelete) {
                if (!empty($imageToDelete)) {
                    Storage::disk('public')->delete($imageToDelete);
                    $existingImages = array_filter($existingImages, fn($img) => $img !== $imageToDelete);
                }
            }
            $existingImages = array_values($existingImages); // Re-index array
        }

        // Handle new images upload - filter empty inputs
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            foreach ($files as $imageFile) {
                if ($imageFile && $imageFile->isValid()) {
                    if (count($existingImages) >= 3)
                        break;
                    $existingImages[] = $imageFile->store('rooms', 'public');
                }
            }
        }

        // First image is the profile image
        $validated['image'] = count($existingImages) > 0 ? $existingImages[0] : null;
        $validated['images'] = $existingImages;

        // Keep floor if not provided
        $validated['floor'] = $room->floor;

        $room->update($validated);

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil diperbarui');
    }

    public function destroy(Room $room)
    {
        if ($room->image) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        return redirect()->route('admin.rooms.index')
            ->with('success', 'Ruangan berhasil dihapus');
    }
}

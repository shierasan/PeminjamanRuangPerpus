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

        return view('admin.rooms.index', compact('rooms', 'allBookings', 'totalRooms'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Set default values
        $validated['floor'] = 'Lantai 1'; // Default floor
        $validated['is_available'] = true;

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

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

        return view('admin.rooms.edit', compact('room', 'bookings'));
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'delete_image' => 'nullable|boolean',
        ]);

        // Handle image deletion
        if ($request->delete_image == '1') {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
                $validated['image'] = null;
            }
        }

        // Handle new image upload
        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::disk('public')->delete($room->image);
            }
            $validated['image'] = $request->file('image')->store('rooms', 'public');
        }

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

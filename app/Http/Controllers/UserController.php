<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class UserController extends Controller
{
    public function dashboard()
    {
        // Get latest 3 announcements for display
        $announcements = Announcement::orderBy('published_date', 'desc')
            ->limit(3)
            ->get();

        return view('user.dashboard', compact('announcements'));
    }

    public function rooms(Request $request)
    {
        $query = \App\Models\Room::query();

        // Search by name
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Filter by floor
        if ($request->filled('floor')) {
            $query->where('floor', $request->floor);
        }

        // Paginate rooms
        $rooms = $query->paginate(4);

        // Get popular rooms (most booked)
        $popularRooms = \App\Models\Room::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->limit(3)
            ->get();

        // Get total rooms count
        $totalRooms = \App\Models\Room::count();

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

        return view('user.rooms', compact('rooms', 'popularRooms', 'allBookings', 'totalRooms', 'allClosures'));
    }

    public function roomDetail($id)
    {
        $room = \App\Models\Room::findOrFail($id);

        // Get bookings for this room to show in calendar
        $bookings = \App\Models\Booking::where('room_id', $id)
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

        // Get closures for this room
        $closures = \App\Models\RoomClosure::forRoom($id)
            ->where('closure_date', '>=', now()->toDateString())
            ->get()
            ->map(function ($closure) {
                return [
                    'closure_date' => $closure->closure_date->format('Y-m-d'),
                    'start_time' => $closure->start_time,
                    'end_time' => $closure->end_time,
                    'reason' => $closure->reason,
                    'is_whole_day' => $closure->isWholeDay(),
                ];
            });

        return view('user.room-detail', compact('room', 'bookings', 'closures'));
    }

    public function createBooking($id)
    {
        $room = \App\Models\Room::findOrFail($id);
        $selectedDate = request('date');

        return view('user.booking-form', compact('room', 'selectedDate'));
    }

    public function storeBooking(Request $request)
    {
        // Debug: Log all request data
        \Log::info('Booking Request Data:', $request->all());
        \Log::info('Has letter_file:', ['has' => $request->hasFile('letter_file')]);
        \Log::info('Has rundown_file:', ['has' => $request->hasFile('rundown_file')]);

        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'booking_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
            'event_name' => 'required|string',
            'organizer' => 'required|string',
            'participants_count' => 'required|integer',
            'letter_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'rundown_file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        // Check if booking date is Sunday (only Sunday is blocked)
        $bookingDate = \Carbon\Carbon::parse($validated['booking_date']);
        if ($bookingDate->isSunday()) {
            return redirect()->back()->withInput()->with('error', 'Tidak dapat meminjam ruangan di hari Minggu.');
        }

        // Check for room closure
        $closureDate = $bookingDate->format('Y-m-d');

        // Get all closures for this room (including all-room closures) on this date
        $closures = \App\Models\RoomClosure::where(function ($q) use ($validated) {
            $q->whereNull('room_id') // all rooms closed
                ->orWhere('room_id', $validated['room_id']);
        })
            ->whereDate('closure_date', $closureDate)
            ->get();

        foreach ($closures as $closure) {
            // If whole day closure (no start/end time), block completely
            if (is_null($closure->start_time) && is_null($closure->end_time)) {
                $roomName = $closure->room_id ? $closure->room->name : 'Semua Ruangan';
                return redirect()->back()->withInput()->with('error', 'Ruangan tidak tersedia pada tanggal ini (' . $roomName . '): ' . $closure->reason);
            }

            // If time-specific closure, check for overlap
            if ($closure->start_time && $closure->end_time) {
                $bookingStart = $validated['start_time'];
                $bookingEnd = $validated['end_time'];

                // Check if booking time overlaps with closure time
                if ($bookingStart < $closure->end_time && $bookingEnd > $closure->start_time) {
                    $roomName = $closure->room_id ? $closure->room->name : 'Semua Ruangan';
                    return redirect()->back()->withInput()->with('error', 'Ruangan tidak tersedia pada waktu tersebut (' . $roomName . '): ' . $closure->reason);
                }
            }
        }

        // Check for time conflict with approved bookings
        $conflictingBooking = \App\Models\Booking::where('room_id', $validated['room_id'])
            ->where('booking_date', $validated['booking_date'])
            ->where('status', 'approved')
            ->where(function ($query) use ($validated) {
                // Check if time slots overlap
                $query->where(function ($q) use ($validated) {
                    $q->where('start_time', '<', $validated['end_time'])
                        ->where('end_time', '>', $validated['start_time']);
                });
            })
            ->first();

        if ($conflictingBooking) {
            return redirect()->back()->withInput()->with(
                'error',
                'Waktu yang dipilih bertabrakan dengan peminjaman yang sudah disetujui pada jam ' .
                $conflictingBooking->start_time . ' - ' . $conflictingBooking->end_time . '. Silakan pilih waktu lain.'
            );
        }

        // Handle file uploads
        if ($request->hasFile('letter_file')) {
            $filePath = $request->file('letter_file')->store('booking-letters', 'public');
            $validated['letter_file'] = $filePath;
            \Log::info('Letter file uploaded:', ['path' => $filePath]);
        }

        if ($request->hasFile('rundown_file')) {
            $filePath = $request->file('rundown_file')->store('booking-rundowns', 'public');
            $validated['rundown_file'] = $filePath;
            \Log::info('Rundown file uploaded:', ['path' => $filePath]);
        }

        // Create booking
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $booking = \App\Models\Booking::create($validated);

        // Debug: Log saved booking
        \Log::info('Booking created:', [
            'id' => $booking->id,
            'letter_file' => $booking->letter_file,
            'rundown_file' => $booking->rundown_file
        ]);

        // Get room for notifications
        $room = \App\Models\Room::find($validated['room_id']);

        // Create notification for user
        \App\Models\Notification::create([
            'user_id' => auth()->id(),
            'booking_id' => $booking->id,
            'type' => 'booking_submitted',
            'title' => 'Permohonan peminjaman berhasil diajukan',
            'message' => 'Peminjaman ruangan ' . $room->name . ' pada ' . date('d M Y', strtotime($booking->booking_date)) . ' berhasil diajukan.',
            'link' => route('user.bookings.detail', $booking->id),
        ]);

        // Create notification for all admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'booking_id' => $booking->id,
                'type' => 'new_booking',
                'title' => auth()->user()->name . ' baru saja mengajukan peminjaman ruangan',
                'message' => 'Peminjaman ruangan ' . $room->name . ' menunggu persetujuan.',
                'link' => route('admin.bookings.show', $booking->id),
            ]);
        }

        return redirect()->route('user.rooms')->with('success', 'Booking berhasil diajukan!');
    }

    public function history()
    {
        $bookings = \App\Models\Booking::where('user_id', auth()->id())
            ->with('room')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.history', compact('bookings'));
    }

    public function bookingDetail($id)
    {
        $booking = \App\Models\Booking::with('room')->findOrFail($id);

        // Ensure user can only view their own bookings
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.booking-detail', compact('booking'));
    }

    public function notifications()
    {
        $notifications = \App\Models\Notification::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('user.notifications', compact('notifications'));
    }

    public function markNotificationAsRead($id)
    {
        $notification = \App\Models\Notification::findOrFail($id);

        // Mark as read
        $notification->update(['is_read' => true]);

        // Prioritize booking_id - redirect directly to booking detail
        if ($notification->booking_id) {
            return redirect()->route('user.bookings.detail', $notification->booking_id);
        }

        // Use link field if available (for announcements, aspirations, etc)
        if ($notification->link) {
            return redirect($notification->link);
        }

        // Fallback to history page
        return redirect()->route('user.history');
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function announcements()
    {
        $announcements = Announcement::where('is_active', true)
            ->orderBy('published_date', 'desc')
            ->paginate(10);

        return view('user.announcements.index', compact('announcements'));
    }

    public function announcementDetail($id)
    {
        $announcement = Announcement::findOrFail($id);

        return view('user.announcements.show', compact('announcement'));
    }
}

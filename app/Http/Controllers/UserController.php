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

        return view('user.rooms', compact('rooms', 'popularRooms'));
    }

    public function roomDetail($id)
    {
        $room = \App\Models\Room::findOrFail($id);

        // Get bookings for this room to show in calendar
        $bookings = \App\Models\Booking::where('room_id', $id)
            ->whereIn('status', ['approved', 'pending'])
            ->get();

        return view('user.room-detail', compact('room', 'bookings'));
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
            'link' => route('user.rooms'),
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
                'link' => route('admin.bookings.index'),
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

        // Redirect to history page
        return redirect()->route('user.history');
    }

    public function profile()
    {
        return view('user.profile');
    }
}

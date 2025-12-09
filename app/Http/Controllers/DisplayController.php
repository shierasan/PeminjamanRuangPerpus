<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomClosure;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DisplayController extends Controller
{
    /**
     * Display rooms grid with calendar
     */
    public function index(Request $request)
    {
        $rooms = Room::orderBy('name')->get();

        // Get selected date from request or default to today
        $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));

        // Get bookings for the selected date (approved only)
        $bookings = Booking::with(['user', 'room'])
            ->where('booking_date', $selectedDate)
            ->where('status', 'approved')
            ->orderBy('start_time')
            ->get();

        // Get all approved bookings for calendar highlighting
        $bookedDates = Booking::where('status', 'approved')
            ->selectRaw('DATE(booking_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Get closures for calendar (all-room closures)
        $closedDates = RoomClosure::whereNull('room_id')
            ->whereNull('start_time')
            ->whereNull('end_time')
            ->pluck('closure_date')
            ->map(fn($d) => $d->format('Y-m-d'))
            ->toArray();

        return view('display.index', compact('rooms', 'bookings', 'selectedDate', 'bookedDates', 'closedDates'));
    }

    /**
     * Display room detail with bookings
     */
    public function showRoom(Request $request, $id)
    {
        $room = Room::findOrFail($id);

        // Get selected date from request or default to today
        $selectedDate = $request->get('date', Carbon::today()->format('Y-m-d'));

        // Sort order
        $sortBy = $request->get('sort', 'asc'); // asc = earliest first

        // Get bookings for this room on selected date (approved only)
        $bookings = Booking::with('user')
            ->where('room_id', $id)
            ->where('booking_date', $selectedDate)
            ->where('status', 'approved')
            ->orderBy('start_time', $sortBy)
            ->get();

        // Get all approved bookings for this room for calendar highlighting
        $bookedDates = Booking::where('room_id', $id)
            ->where('status', 'approved')
            ->selectRaw('DATE(booking_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Get closures for this room (including all-room closures)
        $closedDates = RoomClosure::where(function ($q) use ($id) {
            $q->whereNull('room_id')
                ->orWhere('room_id', $id);
        })
            ->whereNull('start_time')
            ->whereNull('end_time')
            ->pluck('closure_date')
            ->map(fn($d) => $d->format('Y-m-d'))
            ->toArray();

        return view('display.room', compact('room', 'bookings', 'selectedDate', 'sortBy', 'bookedDates', 'closedDates'));
    }
}

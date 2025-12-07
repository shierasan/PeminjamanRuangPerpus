<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room'])
            ->where('cancellation_requested', false);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('room', function ($roomQuery) use ($search) {
                    $roomQuery->where('name', 'like', "%{$search}%");
                })
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%");
                    })
                    ->orWhere('event_name', 'like', "%{$search}%")
                    ->orWhere('organizer', 'like', "%{$search}%");
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'desc'); // 'desc' = Terbaru, 'asc' = Terlama
        $bookings = $query->orderBy('created_at', $sortBy)->paginate(10);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load(['user', 'room']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function approve(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => 'approved',
            'admin_note' => $request->input('note'),
        ]);

        // Load room relationship
        $booking->load('room');

        // Send notification to user
        \App\Models\Notification::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'type' => 'booking_approved',
            'title' => 'Peminjaman Disetujui',
            'message' => 'Peminjaman ruangan ' . $booking->room->name . ' pada ' . $booking->booking_date->format('d M Y') . ' telah disetujui.',
            'link' => route('user.bookings.detail', $booking->id),
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Peminjaman berhasil disetujui');
    }

    public function reject(Request $request, Booking $booking)
    {
        $request->validate([
            'note' => 'required|string',
        ]);

        $booking->update([
            'status' => 'rejected',
            'admin_note' => $request->input('note'),
        ]);

        // Load room relationship
        $booking->load('room');

        // Send notification to user
        \App\Models\Notification::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'type' => 'booking_rejected',
            'title' => 'Peminjaman Ditolak',
            'message' => 'Peminjaman ruangan ' . $booking->room->name . ' pada ' . $booking->booking_date->format('d M Y') . ' ditolak. Alasan: ' . $request->input('note'),
            'link' => route('user.bookings.detail', $booking->id),
        ]);

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Peminjaman berhasil ditolak');
    }
}

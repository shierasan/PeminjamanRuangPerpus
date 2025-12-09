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

        // Sort by booking date (not created_at)
        $sortBy = $request->get('sort', 'desc'); // 'desc' = Terbaru, 'asc' = Terlama
        $bookings = $query->orderBy('booking_date', $sortBy)
            ->orderBy('start_time', $sortBy)
            ->paginate(10);

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

    public function markKeyReturned(Booking $booking)
    {
        $booking->update([
            'key_returned' => true,
            'key_returned_at' => now(),
            'completed_at' => now(),
        ]);

        // Load relationships
        $booking->load(['room', 'user']);

        // Send notification to user
        \App\Models\Notification::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'type' => 'key_returned',
            'title' => 'Kunci Ruangan Telah Dikembalikan',
            'message' => 'Terima kasih telah mengembalikan kunci ruangan ' . $booking->room->name . '. Peminjaman Anda telah selesai.',
            'link' => route('user.bookings.detail', $booking->id),
        ]);

        // Send notification to all admins
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            \App\Models\Notification::create([
                'user_id' => $admin->id,
                'booking_id' => $booking->id,
                'type' => 'booking_completed',
                'title' => 'Peminjaman Selesai',
                'message' => 'Peminjaman ruangan ' . $booking->room->name . ' oleh ' . $booking->user->name . ' telah selesai. Kunci telah dikembalikan pada ' . now()->format('d M Y H:i') . '.',
                'link' => route('admin.bookings.show', $booking->id),
            ]);
        }

        return redirect()->back()->with('success', 'Kunci ruangan berhasil ditandai sebagai dikembalikan.');
    }
}

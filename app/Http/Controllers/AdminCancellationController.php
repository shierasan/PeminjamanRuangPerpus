<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminCancellationController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['user', 'room'])
            ->where('cancellation_requested', true);

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
        $cancellations = $query->orderBy('created_at', $sortBy)->paginate(10);

        return view('admin.cancellations.index', compact('cancellations'));
    }

    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'cancellation_status' => 'approved',
            'status' => 'cancelled'
        ]);

        // Send notification to user
        $booking->load('room');
        \App\Models\Notification::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'type' => 'cancellation_approved',
            'title' => 'Pembatalan Disetujui',
            'message' => 'Pembatalan peminjaman ruangan ' . $booking->room->name . ' pada ' . $booking->booking_date->format('d M Y') . ' telah disetujui. Ruangan kini tersedia untuk peminjam lain.',
            'link' => route('user.bookings.detail', $booking->id),
        ]);

        return redirect()->back()->with('success', 'Pembatalan disetujui. Ruangan kini tersedia untuk peminjam lain.');
    }

    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update([
            'cancellation_status' => 'rejected',
            'cancellation_requested' => false
        ]);

        // Send notification to user
        $booking->load('room');
        \App\Models\Notification::create([
            'user_id' => $booking->user_id,
            'booking_id' => $booking->id,
            'type' => 'cancellation_rejected',
            'title' => 'Pembatalan Ditolak',
            'message' => 'Pembatalan peminjaman ruangan ' . $booking->room->name . ' pada ' . $booking->booking_date->format('d M Y') . ' ditolak. Silakan tetap hadir sesuai jadwal.',
            'link' => route('user.bookings.detail', $booking->id),
        ]);

        return redirect()->back()->with('success', 'Pembatalan ditolak');
    }
}

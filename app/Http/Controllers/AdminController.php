<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::pending()->count(),
            'approved_bookings' => Booking::approved()->count(),
            'rejected_bookings' => Booking::rejected()->count(),
            'total_rooms' => Room::count(),
            'available_rooms' => Room::where('is_available', true)->count(),
        ];

        $pending_bookings = Booking::with(['user', 'room'])
            ->pending()
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $today_bookings = Booking::with(['user', 'room'])
            ->where('booking_date', today())
            ->approved()
            ->get();

        return view('admin.dashboard', compact('stats', 'pending_bookings', 'today_bookings'));
    }

    public function notifications(Request $request)
    {
        $query = \App\Models\Notification::where('user_id', auth()->id());

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by read status
        if ($request->filled('status')) {
            if ($request->status === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->status === 'read') {
                $query->where('is_read', true);
            }
        }

        // Sort
        $sortBy = $request->get('sort', 'desc');
        $notifications = $query->orderBy('created_at', $sortBy)->get();

        // Get unique types for filter dropdown
        $types = \App\Models\Notification::where('user_id', auth()->id())
            ->distinct()
            ->pluck('type')
            ->filter()
            ->values();

        return view('admin.notifications', compact('notifications', 'types'));
    }

    public function markAsRead($id)
    {
        $notification = \App\Models\Notification::findOrFail($id);

        // Mark as read
        $notification->update(['is_read' => true]);

        // Prioritize booking_id - redirect directly to booking detail
        if ($notification->booking_id) {
            return redirect()->route('admin.bookings.show', $notification->booking_id);
        }

        // Use link field if available (for aspirations, etc)
        if ($notification->link) {
            return redirect($notification->link);
        }

        // Fallback to bookings index
        return redirect()->route('admin.bookings.index');
    }
}

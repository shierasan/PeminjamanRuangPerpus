<?php

namespace App\Http\Controllers;

use App\Models\RoomClosure;
use App\Models\Room;
use Illuminate\Http\Request;

class AdminRoomClosureController extends Controller
{
    public function index()
    {
        $closures = RoomClosure::with('room')
            ->orderBy('closure_date', 'desc')
            ->paginate(10);

        return view('admin.closures.index', compact('closures'));
    }

    public function create()
    {
        $rooms = Room::orderBy('name')->get();
        return view('admin.closures.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        // Validate room_id separately since 'all' is a special value
        $roomId = $request->input('room_id');

        // Check if room_id is a valid room or 'all'
        if ($roomId !== 'all' && !empty($roomId)) {
            if (!Room::find($roomId)) {
                return back()->withErrors(['room_id' => 'Ruangan tidak ditemukan.'])->withInput();
            }
        }

        $validated = $request->validate([
            'closure_date' => 'required|date|after_or_equal:today',
            'closure_type' => 'required|in:whole_day,specific',
            'start_time' => 'nullable|date_format:H:i',
            'end_time' => 'nullable|date_format:H:i|after:start_time',
            'reason' => 'required|string|max:255',
            'send_announcement' => 'nullable',
        ]);

        // Convert 'all' to null for all rooms closure
        $validated['room_id'] = ($roomId === 'all' || empty($roomId)) ? null : $roomId;

        // If whole day, clear time fields
        if ($validated['closure_type'] === 'whole_day') {
            $validated['start_time'] = null;
            $validated['end_time'] = null;
        }

        // Get room name for announcement
        $roomName = $validated['room_id']
            ? Room::find($validated['room_id'])->name
            : 'Semua Ruangan';

        $closure = RoomClosure::create([
            'room_id' => $validated['room_id'],
            'closure_date' => $validated['closure_date'],
            'start_time' => $validated['start_time'] ?? null,
            'end_time' => $validated['end_time'] ?? null,
            'reason' => $validated['reason'],
        ]);

        // Create announcement if checkbox is checked
        if ($request->has('send_announcement')) {
            $closureDate = \Carbon\Carbon::parse($validated['closure_date'])->format('d M Y');

            $timeInfo = ($validated['closure_type'] === 'whole_day')
                ? 'Seharian'
                : \Carbon\Carbon::parse($validated['start_time'])->format('H:i') . ' - ' . \Carbon\Carbon::parse($validated['end_time'])->format('H:i');

            $title = "Pemberitahuan Penutupan Ruangan - {$roomName}";
            $content = "Diberitahukan kepada seluruh pengguna bahwa {$roomName} akan TUTUP.\n\n";
            $content .= "Tanggal: {$closureDate}\n";
            $content .= "Waktu: {$timeInfo}\n";
            $content .= "Alasan: {$validated['reason']}\n\n";
            $content .= "Mohon maaf atas ketidaknyamanannya. Silakan pilih ruangan atau waktu lain untuk peminjaman.";

            \App\Models\Announcement::create([
                'title' => $title,
                'content' => $content,
                'published_date' => now(),
                'is_active' => true,
            ]);
        }

        return redirect()->route('admin.closures.index')
            ->with('success', 'Penutupan ruangan berhasil ditambahkan.' . ($request->has('send_announcement') ? ' Pengumuman telah dikirim ke semua user.' : ''));
    }

    public function destroy(RoomClosure $closure)
    {
        $closure->delete();

        return redirect()->route('admin.closures.index')
            ->with('success', 'Penutupan ruangan berhasil dihapus.');
    }
}

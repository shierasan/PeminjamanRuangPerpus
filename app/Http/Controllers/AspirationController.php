<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspiration;
use App\Models\Room;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Storage;

class AspirationController extends Controller
{
    // User: Submit new aspiration
    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'nullable|exists:rooms,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'documentation_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('documentation_file')) {
            $filePath = $request->file('documentation_file')->store('aspiration-docs', 'public');
            $validated['documentation_file'] = $filePath;
        }

        // Create aspiration
        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        $aspiration = Aspiration::create($validated);

        // Create notification for user - link to aspiration detail
        Notification::create([
            'user_id' => auth()->id(),
            'type' => 'aspiration_submitted',
            'title' => 'Aspirasi berhasil dikirim',
            'message' => 'Aspirasi Anda dengan judul "' . $aspiration->title . '" berhasil dikirim.',
            'link' => route('user.aspirations.show', $aspiration->id),
        ]);

        // Create notification for all admins - link to aspiration detail
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'new_aspiration',
                'title' => 'Aspirasi baru dari ' . auth()->user()->name,
                'message' => 'Aspirasi dengan judul "' . $aspiration->title . '" menunggu ditinjau.',
                'link' => route('admin.aspirations.show', $aspiration->id),
            ]);
        }

        return redirect()->route('user.profile')->with('success', 'Aspirasi berhasil dikirim!');
    }

    // User: View own aspiration detail
    public function userShow($id)
    {
        $aspiration = Aspiration::with(['user', 'room'])->findOrFail($id);

        // Ensure user can only view their own aspirations
        if ($aspiration->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.aspiration-detail', compact('aspiration'));
    }

    // Admin: View all aspirations
    public function index(Request $request)
    {
        $query = Aspiration::with(['user', 'room'])->orderBy('created_at', 'desc');

        // Search by user name
        if ($request->filled('search')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Sort
        if ($request->filled('sort')) {
            if ($request->sort === 'terbaru') {
                $query->orderBy('created_at', 'desc');
            } elseif ($request->sort === 'terlama') {
                $query->orderBy('created_at', 'asc');
            }
        }

        $aspirations = $query->paginate(10);

        return view('admin.aspirations.index', compact('aspirations'));
    }

    // Admin: View aspiration detail
    public function show($id)
    {
        $aspiration = Aspiration::with(['user', 'room'])->findOrFail($id);

        return view('admin.aspirations.show', compact('aspiration'));
    }

    // Admin: Delete aspiration
    public function destroy($id)
    {
        $aspiration = Aspiration::findOrFail($id);

        // Delete file if exists
        if ($aspiration->documentation_file) {
            Storage::disk('public')->delete($aspiration->documentation_file);
        }

        $aspiration->delete();

        return redirect()->route('admin.aspirations.index')->with('success', 'Aspirasi berhasil dihapus!');
    }
}


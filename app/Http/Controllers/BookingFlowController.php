<?php

namespace App\Http\Controllers;

use App\Models\BookingFlow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookingFlowController extends Controller
{
    /**
     * Admin - View and edit booking flow steps.
     */
    public function adminIndex()
    {
        $steps = BookingFlow::orderBy('step_number')->get();
        return view('admin.booking-flow.index', compact('steps'));
    }

    /**
     * Admin - Store or update all steps.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'steps' => 'required|array',
            'steps.*.id' => 'nullable|integer',
            'steps.*.title' => 'required|string|max:255',
            'steps.*.description' => 'required|string',
        ]);

        // Get existing step IDs
        $existingIds = BookingFlow::pluck('id')->toArray();
        $submittedIds = [];

        foreach ($request->steps as $index => $stepData) {
            $stepNumber = $index + 1;

            if (!empty($stepData['id'])) {
                // Update existing step
                $step = BookingFlow::find($stepData['id']);
                if ($step) {
                    $step->update([
                        'step_number' => $stepNumber,
                        'title' => $stepData['title'],
                        'description' => $stepData['description'],
                    ]);
                    $submittedIds[] = $step->id;
                }
            } else {
                // Create new step
                $step = BookingFlow::create([
                    'step_number' => $stepNumber,
                    'title' => $stepData['title'],
                    'description' => $stepData['description'],
                ]);
                $submittedIds[] = $step->id;
            }
        }

        // Delete removed steps
        $toDelete = array_diff($existingIds, $submittedIds);
        if (!empty($toDelete)) {
            BookingFlow::whereIn('id', $toDelete)->delete();
        }

        return redirect()->route('admin.booking-flow.index')
            ->with('success', 'Alur peminjaman berhasil diperbarui.');
    }

    /**
     * Admin - Upload image for a step.
     */
    public function uploadImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $step = BookingFlow::findOrFail($id);

        // Delete old image if exists
        if ($step->image) {
            Storage::disk('public')->delete($step->image);
        }

        // Store new image
        $path = $request->file('image')->store('booking-flow', 'public');
        $step->update(['image' => $path]);

        return response()->json(['success' => true, 'path' => $path]);
    }

    /**
     * Admin - Delete image for a step.
     */
    public function deleteImage($id)
    {
        $step = BookingFlow::findOrFail($id);

        if ($step->image) {
            Storage::disk('public')->delete($step->image);
            $step->update(['image' => null]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * User - View booking flow.
     */
    public function publicIndex()
    {
        $steps = BookingFlow::orderBy('step_number')->get();
        return view('user.booking-flow', compact('steps'));
    }
}

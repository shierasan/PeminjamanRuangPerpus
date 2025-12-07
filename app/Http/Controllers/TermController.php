<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Term;
use Illuminate\Support\Facades\Storage;

class TermController extends Controller
{
    // Admin: View all terms
    public function adminIndex()
    {
        $persyaratanUmum = Term::where('category', 'persyaratan_umum')->orderBy('order')->get();
        $larangan = Term::where('category', 'larangan')->orderBy('order')->get();
        $document = Term::whereNotNull('document_file')->first();

        return view('admin.terms.index', compact('persyaratanUmum', 'larangan', 'document'));
    }

    // Admin: Show edit page
    public function edit()
    {
        $persyaratanUmum = Term::where('category', 'persyaratan_umum')->orderBy('order')->get();
        $larangan = Term::where('category', 'larangan')->orderBy('order')->get();
        $document = Term::whereNotNull('document_file')->first();

        return view('admin.terms.edit', compact('persyaratanUmum', 'larangan', 'document'));
    }

    // Admin: Store new term
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:persyaratan_umum,larangan',
            'content' => 'required|string',
        ]);

        $maxOrder = Term::where('category', $validated['category'])->max('order') ?? 0;
        $validated['order'] = $maxOrder + 1;

        Term::create($validated);

        return redirect()->route('admin.terms.edit')->with('success', 'Syarat berhasil ditambahkan!');
    }

    // Admin: Update terms (bulk)
    public function update(Request $request)
    {
        // Handle document upload
        if ($request->hasFile('document_file')) {
            $filePath = $request->file('document_file')->store('terms-documents', 'public');

            // Delete old document if exists
            $existingDoc = Term::whereNotNull('document_file')->first();
            if ($existingDoc) {
                Storage::disk('public')->delete($existingDoc->document_file);
                $existingDoc->update(['document_file' => $filePath]);
            } else {
                // Create a placeholder term to hold the document
                Term::create([
                    'category' => 'document',
                    'content' => 'Document holder',
                    'document_file' => $filePath,
                ]);
            }
        }

        return redirect()->route('admin.terms.index')->with('success', 'Syarat dan ketentuan berhasil disimpan!');
    }

    // Admin: Delete term
    public function destroy($id)
    {
        $term = Term::findOrFail($id);
        $term->delete();

        return response()->json(['success' => true]);
    }

    // Admin: Upload document
    public function uploadDocument(Request $request)
    {
        $request->validate([
            'document_file' => 'required|file|mimes:pdf,doc,docx|max:5120',
        ]);

        if ($request->hasFile('document_file')) {
            $filePath = $request->file('document_file')->store('terms-documents', 'public');

            // Delete old document if exists
            $existingDoc = Term::whereNotNull('document_file')->first();
            if ($existingDoc) {
                Storage::disk('public')->delete($existingDoc->document_file);
                $existingDoc->update(['document_file' => $filePath]);
            } else {
                Term::create([
                    'category' => 'document',
                    'content' => 'Document holder',
                    'document_file' => $filePath,
                ]);
            }
        }

        return redirect()->route('admin.terms.index')->with('success', 'Dokumen berhasil diupload!');
    }

    // User: View terms
    public function userIndex()
    {
        $persyaratanUmum = Term::where('category', 'persyaratan_umum')->orderBy('order')->get();
        $larangan = Term::where('category', 'larangan')->orderBy('order')->get();
        $document = Term::whereNotNull('document_file')->first();

        return view('user.terms', compact('persyaratanUmum', 'larangan', 'document'));
    }

    // Public: View terms (no login required)
    public function publicIndex()
    {
        $persyaratanUmum = Term::where('category', 'persyaratan_umum')->orderBy('order')->get();
        $larangan = Term::where('category', 'larangan')->orderBy('order')->get();
        $document = Term::whereNotNull('document_file')->first();

        return view('public.terms', compact('persyaratanUmum', 'larangan', 'document'));
    }
}

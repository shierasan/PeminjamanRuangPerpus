<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Get or create default contact
    private function getContact()
    {
        $contact = Contact::first();
        if (!$contact) {
            $contact = Contact::create([
                'phone_title' => 'Penjaga Perpustakaan',
                'phone_number' => '0899 0087 1234',
                'email_title' => 'Admin Perpustakaan',
                'email_address' => 'lib.unand.ac@gmail.com',
                'location_title' => 'Perpustakaan Universitas Andalas',
                'location_address' => 'Kampus Universitas Andalas, Limau Manis, Kec. Pauh, Kota Padang.',
            ]);
        }
        return $contact;
    }

    // Admin: View contact info
    public function adminIndex()
    {
        $contact = $this->getContact();
        return view('admin.contacts.index', compact('contact'));
    }

    // Admin: Show edit form
    public function edit()
    {
        $contact = $this->getContact();
        return view('admin.contacts.edit', compact('contact'));
    }

    // Admin: Update contact info
    public function update(Request $request)
    {
        $validated = $request->validate([
            'phone_title' => 'required|string|max:255',
            'phone_number' => 'required|string|max:50',
            'email_title' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'location_title' => 'required|string|max:255',
            'location_address' => 'required|string',
        ]);

        $contact = $this->getContact();
        $contact->update($validated);

        return redirect()->route('admin.contacts.index')->with('success', 'Informasi kontak berhasil diperbarui!');
    }

    // User: View contact info
    public function userIndex()
    {
        $contact = $this->getContact();
        return view('user.contacts', compact('contact'));
    }

    // Public: View contact info (no login required)
    public function publicIndex()
    {
        $contact = $this->getContact();
        return view('public.contacts', compact('contact'));
    }
}

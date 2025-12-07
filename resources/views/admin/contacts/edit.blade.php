@extends('layouts.app')

@section('title', 'Edit Kontak dan Layanan')

@section('content')
    <div class="container" style="max-width: 700px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 2rem;">Edit Kontak dan Layanan</h1>

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div
                    style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <strong>Error:</strong>
                    <ul style="margin: 0.5rem 0 0 1.5rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.contacts.update') }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Phone Section --}}
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">Phone</h3>
                    <div style="margin-bottom: 1rem;">
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151; font-size: 0.875rem;">Judul</label>
                        <input type="text" name="phone_title" value="{{ old('phone_title', $contact->phone_title) }}"
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151; font-size: 0.875rem;">Nomor
                            Telepon</label>
                        <input type="text" name="phone_number" value="{{ old('phone_number', $contact->phone_number) }}"
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    </div>
                </div>

                {{-- Email Section --}}
                <div style="margin-bottom: 2rem;">
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">Email</h3>
                    <div style="margin-bottom: 1rem;">
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151; font-size: 0.875rem;">Judul</label>
                        <input type="text" name="email_title" value="{{ old('email_title', $contact->email_title) }}"
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151; font-size: 0.875rem;">Alamat
                            Email</label>
                        <input type="email" name="email_address" value="{{ old('email_address', $contact->email_address) }}"
                            required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    </div>
                </div>

                {{-- Location Section --}}
                <div style="margin-bottom: 2.5rem;">
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 1rem; margin-bottom: 1rem;">Location</h3>
                    <div style="margin-bottom: 1rem;">
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151; font-size: 0.875rem;">Judul</label>
                        <input type="text" name="location_title"
                            value="{{ old('location_title', $contact->location_title) }}" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    </div>
                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151; font-size: 0.875rem;">Alamat
                            Lengkap</label>
                        <textarea name="location_address" required rows="3"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('location_address', $contact->location_address) }}</textarea>
                    </div>
                </div>

                {{-- Buttons --}}
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <a href="{{ route('admin.contacts.index') }}"
                        style="color: #B8985F; text-decoration: underline; font-weight: 500;">
                        Kembali
                    </a>
                    <button type="submit"
                        style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 1rem;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
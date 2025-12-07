@extends('layouts.user')

@section('title', 'Detail Aspirasi')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="margin-bottom: 2rem;">
                <a href="{{ route('user.profile') }}"
                    style="color: #B8985F; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Profil
                </a>
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.75rem;">
                    Detail Aspirasi
                </h1>
            </div>

            {{-- Status Badge --}}
            <div style="margin-bottom: 2rem;">
                @if($aspiration->status == 'pending')
                    <span
                        style="padding: 0.5rem 1rem; background: #FEF3C7; color: #D97706; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">
                        Menunggu Ditinjau
                    </span>
                @elseif($aspiration->status == 'reviewed')
                    <span
                        style="padding: 0.5rem 1rem; background: #D1FAE5; color: #059669; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">
                        Sudah Ditinjau
                    </span>
                @endif
            </div>

            {{-- Aspiration Info --}}
            <div
                style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border: 1px solid rgba(184, 152, 95, 0.3); border-radius: 12px; padding: 2rem; margin-bottom: 1.5rem;">
                <div style="margin-bottom: 1.5rem;">
                    <label
                        style="font-size: 0.875rem; color: #B8985F; font-weight: 600; display: block; margin-bottom: 0.25rem;">Judul
                        Aspirasi</label>
                    <p style="color: #1a1a1a; font-size: 1rem; font-weight: 600;">{{ $aspiration->title }}</p>
                </div>

                @if($aspiration->room)
                    <div style="margin-bottom: 1.5rem;">
                        <label
                            style="font-size: 0.875rem; color: #B8985F; font-weight: 600; display: block; margin-bottom: 0.25rem;">Ruangan
                            Terkait</label>
                        <p style="color: #374151; font-size: 1rem;">{{ $aspiration->room->name }}</p>
                    </div>
                @endif

                <div style="margin-bottom: 1.5rem;">
                    <label
                        style="font-size: 0.875rem; color: #B8985F; font-weight: 600; display: block; margin-bottom: 0.25rem;">Deskripsi</label>
                    <p style="color: #374151; font-size: 0.95rem; line-height: 1.7; white-space: pre-line;">
                        {{ $aspiration->description }}</p>
                </div>

                @if($aspiration->documentation_file)
                    <div style="margin-bottom: 1.5rem;">
                        <label
                            style="font-size: 0.875rem; color: #B8985F; font-weight: 600; display: block; margin-bottom: 0.5rem;">Dokumentasi</label>
                        <a href="{{ asset('storage/' . $aspiration->documentation_file) }}" target="_blank"
                            style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #3b82f6; color: white; text-decoration: none; border-radius: 6px; font-size: 0.875rem;">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                            Lihat Dokumentasi
                        </a>
                    </div>
                @endif

                <div>
                    <label
                        style="font-size: 0.875rem; color: #B8985F; font-weight: 600; display: block; margin-bottom: 0.25rem;">Tanggal
                        Dikirim</label>
                    <p style="color: #374151; font-size: 0.95rem;">{{ $aspiration->created_at->format('d F Y, H:i') }}</p>
                </div>
            </div>

            {{-- Admin Response (if any) --}}
            @if($aspiration->admin_response)
                <div style="background: #E8F5E9; border: 1px solid #10b981; border-radius: 12px; padding: 1.5rem;">
                    <h3
                        style="color: #059669; font-weight: 600; margin-bottom: 0.75rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tanggapan Admin
                    </h3>
                    <p style="color: #374151; font-size: 0.95rem; line-height: 1.7;">{{ $aspiration->admin_response }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
@extends('layouts.user')

@section('title', 'Syarat dan Ketentuan Peminjaman')

@section('content')
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Informasi</h1>

            {{-- Title Section --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #B8985F; margin-bottom: 0.5rem;">Syarat dan Ketentuan
                    Peminjaman</h2>
                <p style="color: #666; font-size: 0.95rem;">Pahami persyaratan dan ketentuan dalam peminjaman ruangan
                    Universitas Andalas</p>
            </div>

            {{-- Terms Content Card --}}
            <div
                style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border: 1px solid rgba(184, 152, 95, 0.3); border-radius: 12px; padding: 2rem; margin-bottom: 1.5rem;">
                {{-- Persyaratan Umum --}}
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 0.95rem; margin-bottom: 0.75rem;">Persyaratan
                        Umum</h3>
                    @if($persyaratanUmum->count() > 0)
                        <ul style="margin: 0; padding-left: 1.25rem; color: #374151; font-size: 0.9rem; line-height: 1.8;">
                            @foreach($persyaratanUmum as $term)
                                <li>{{ $term->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p style="color: #9ca3af; font-size: 0.875rem; font-style: italic;">Belum ada persyaratan umum</p>
                    @endif
                </div>

                {{-- Larangan --}}
                <div>
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 0.95rem; margin-bottom: 0.75rem;">Larangan</h3>
                    @if($larangan->count() > 0)
                        <ul style="margin: 0; padding-left: 1.25rem; color: #374151; font-size: 0.9rem; line-height: 1.8;">
                            @foreach($larangan as $term)
                                <li>{{ $term->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p style="color: #9ca3af; font-size: 0.875rem; font-style: italic;">Belum ada larangan</p>
                    @endif
                </div>
            </div>

            {{-- Document Download Section --}}
            <div
                style="background: #E3F2FD; border-radius: 12px; padding: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #1a1a1a; font-weight: 500;">Pahami syarat dan ketentuan</span>
                @if($document)
                    <a href="{{ asset('storage/' . $document->document_file) }}" target="_blank" download
                        style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #3b82f6; color: white; text-decoration: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                        Download Dokumen
                    </a>
                @else
                    <span style="color: #6b7280; font-size: 0.875rem; font-style: italic;">Dokumen belum tersedia</span>
                @endif
            </div>
        </div>
    </div>
@endsection
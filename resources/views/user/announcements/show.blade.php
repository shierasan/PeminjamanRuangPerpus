@extends('layouts.user')

@section('title', $announcement->title)

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="margin-bottom: 2rem;">
                <a href="{{ route('user.announcements.index') }}"
                    style="color: #B8985F; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali ke Daftar Pengumuman
                </a>
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.75rem;">
                    {{ $announcement->title }}
                </h1>
                <div style="display: flex; align-items: center; gap: 1rem; color: #666; font-size: 0.875rem;">
                    <span style="display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        {{ $announcement->published_date->format('d F Y') }}
                    </span>
                </div>
            </div>

            {{-- Content --}}
            <div style="border-top: 1px solid #e5e7eb; padding-top: 2rem;">
                <div style="color: #374151; font-size: 1rem; line-height: 1.8; white-space: pre-line;">
                    {{ $announcement->content }}
                </div>
            </div>

            {{-- Share or Actions --}}
            <div
                style="margin-top: 2.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('user.announcements.index') }}"
                    style="color: #B8985F; text-decoration: underline; font-weight: 500;">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
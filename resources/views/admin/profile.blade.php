@extends('layouts.app')

@section('title', 'Profile Admin')

@section('content')
    <div class="container" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 2rem;">Profile</h1>

            {{-- Profile Info Card --}}
            <div
                style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
                <div style="display: flex; align-items: center; gap: 1.5rem;">
                    {{-- Avatar --}}
                    <div
                        style="width: 80px; height: 80px; background: linear-gradient(135deg, #B8985F, #9d7d4b); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="50" height="50" fill="none" stroke="white" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                            </path>
                        </svg>
                    </div>

                    {{-- Info --}}
                    <div style="flex: 1;">
                        <h2 style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">
                            {{ auth()->user()->name }}
                        </h2>
                        <p style="font-size: 1rem; color: #666; margin-bottom: 0.25rem;">
                            <strong>Email:</strong> {{ auth()->user()->email }}
                        </p>
                        <p style="font-size: 1rem; color: #666;">
                            <strong>Role:</strong> <span style="color: #B8985F; font-weight: 600;">Administrator</span>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Aksi Cepat Section --}}
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 1.25rem; font-weight: 600; color: #1a1a1a; margin-bottom: 1rem;">Aksi Cepat</h3>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    {{-- Riwayat Peminjaman Button --}}
                    <a href="{{ route('admin.history.index') }}"
                        style="display: flex; align-items: center; padding: 1rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(184, 152, 95, 0.2);">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="margin-right: 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span style="font-weight: 600;">Riwayat Peminjaman</span>
                    </a>

                    {{-- Ubah Password Button --}}
                    <a href="#"
                        style="display: flex; align-items: center; padding: 1rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(184, 152, 95, 0.2);">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="margin-right: 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z">
                            </path>
                        </svg>
                        <span style="font-weight: 600;">Ubah Password</span>
                    </a>

                    {{-- Lihat Saran & Aspirasi Button --}}
                    <a href="{{ route('admin.aspirations.index') }}"
                        style="display: flex; align-items: center; padding: 1rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 8px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(184, 152, 95, 0.2);">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="margin-right: 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z">
                            </path>
                        </svg>
                        <span style="font-weight: 600;">Lihat Saran & Aspirasi</span>
                    </a>
                </div>
            </div>

            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    style="width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 1rem 1.5rem; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

    <style>
        /* Hover effects for action buttons */
        a[href]:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(184, 152, 95, 0.3) !important;
        }

        button[type="submit"]:hover {
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
            box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3) !important;
            transform: translateY(-2px);
        }
    </style>
@endsection
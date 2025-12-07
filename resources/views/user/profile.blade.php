@extends('layouts.user')

@section('title', 'Profile')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 900px;">
        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 2rem; color: #1a1a1a;">Profile</h2>

            <!-- User Info Card -->
            <div
                style="background: #FFF9E6; border-radius: 12px; padding: 2rem; margin-bottom: 2rem; display: flex; align-items: center; gap: 1.5rem;">
                <!-- User Icon -->
                <div
                    style="width: 60px; height: 60px; background: #B8985F; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <svg width="30" height="30" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>

                <!-- User Details -->
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.25rem; color: #1a1a1a;">
                        {{ Auth::user()->name }}
                    </h3>
                    <p style="color: #666; font-size: 0.95rem;">
                        {{ Auth::user()->email }}
                    </p>
                </div>
            </div>

            <!-- Aksi Cepat Section -->
            <div style="background: #FFF9E6; border-radius: 12px; padding: 2rem;">
                <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: #1a1a1a;">
                    Aksi Cepat
                </h3>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <!-- Riwayat Peminjaman -->
                    <a href="{{ route('user.history') }}"
                        style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; padding: 1rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s; display: block;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(184, 152, 95, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        Riwayat Peminjaman
                    </a>

                    <!-- Ubah Password -->
                    <a href="#"
                        style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; padding: 1rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s; display: block;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(184, 152, 95, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        Ubah Password
                    </a>

                    <!-- Kirim Saran & Aspirasi -->
                    <a href="#"
                        style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; padding: 1rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s; display: block;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 12px rgba(184, 152, 95, 0.3)'"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                        Kirim Saran & Aspirasi
                    </a>
                </div>
            </div>

            <!-- Logout Button -->
            <div style="margin-top: 2rem;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        style="width: 100%; background: #ef4444; color: white; padding: 1rem; border: none; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='#dc2626'" onmouseout="this.style.background='#ef4444'">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
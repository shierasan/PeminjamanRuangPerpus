@extends('layouts.app')

@section('title', 'Profile Admin')

@section('content')
    <div class="container" style="max-width: 900px; margin: 2rem auto; padding: 0 1rem;">
        <!-- Profile Header with Gradient -->
        <div
            style="background: linear-gradient(135deg, #1a3a3a 0%, #0d4d4d 50%, #008B5C 100%); border-radius: 20px; padding: 3rem; margin-bottom: 2rem; position: relative; overflow: hidden;">
            <!-- Decorative circles -->
            <div
                style="position: absolute; top: -50px; right: -50px; width: 200px; height: 200px; background: rgba(184, 152, 95, 0.1); border-radius: 50%;">
            </div>
            <div
                style="position: absolute; bottom: -30px; left: -30px; width: 150px; height: 150px; background: rgba(184, 152, 95, 0.08); border-radius: 50%;">
            </div>

            <div style="display: flex; align-items: center; gap: 2rem; position: relative; z-index: 1;">
                <!-- Avatar -->
                <div
                    style="width: 100px; height: 100px; background: linear-gradient(135deg, #B8985F, #d4b87a); border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 4px solid rgba(255,255,255,0.3); box-shadow: 0 8px 32px rgba(0,0,0,0.2);">
                    <svg width="50" height="50" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>

                <!-- Admin Info -->
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; color: white; margin-bottom: 0.5rem;">
                        {{ auth()->user()->name }}
                    </h1>
                    <p style="color: rgba(255,255,255,0.8); font-size: 1rem; margin-bottom: 0.75rem;">
                        {{ auth()->user()->email }}
                    </p>
                    <span
                        style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; padding: 0.4rem 1rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">
                        🛡️ Administrator
                    </span>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        @php
            $totalBookings = \App\Models\Booking::count();
            $pendingBookings = \App\Models\Booking::where('status', 'pending')->count();
            $totalRooms = \App\Models\Room::count();
            $totalUsers = \App\Models\User::where('role', 'user')->count();
        @endphp
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
            <div
                style="background: linear-gradient(135deg, #FFF9E6, #fff); border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; border: 2px solid #E6D5A8;">
                <div style="font-size: 1.75rem; font-weight: 700; color: #B8985F;">{{ $totalBookings }}</div>
                <div style="color: #666; font-size: 0.8rem; margin-top: 0.25rem;">Total Booking</div>
            </div>
            <div
                style="background: linear-gradient(135deg, #FFF3E0, #fff); border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; border: 2px solid #ffcc80;">
                <div style="font-size: 1.75rem; font-weight: 700; color: #f59e0b;">{{ $pendingBookings }}</div>
                <div style="color: #666; font-size: 0.8rem; margin-top: 0.25rem;">Perlu Review</div>
            </div>
            <div
                style="background: linear-gradient(135deg, #E8F5E9, #fff); border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; border: 2px solid #a5d6a7;">
                <div style="font-size: 1.75rem; font-weight: 700; color: #008B5C;">{{ $totalRooms }}</div>
                <div style="color: #666; font-size: 0.8rem; margin-top: 0.25rem;">Total Ruangan</div>
            </div>
            <div
                style="background: linear-gradient(135deg, #E3F2FD, #fff); border-radius: 16px; padding: 1.5rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); text-align: center; border: 2px solid #90caf9;">
                <div style="font-size: 1.75rem; font-weight: 700; color: #1976d2;">{{ $totalUsers }}</div>
                <div style="color: #666; font-size: 0.8rem; margin-top: 0.25rem;">Pengguna</div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div
            style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin-bottom: 2rem; border: 1px solid #E6D5A8;">
            <h3
                style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; color: #1a1a1a; display: flex; align-items: center; gap: 0.5rem;">
                <span style="background: #FFF9E6; padding: 0.5rem; border-radius: 8px; border: 1px solid #E6D5A8;">⚙️</span>
                Menu Admin
            </h3>

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                <!-- Kelola Peminjaman -->
                <a href="{{ route('admin.bookings.index') }}"
                    style="background: linear-gradient(135deg, #008B5C, #006B47); color: white; padding: 1.25rem; border-radius: 12px; text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0, 139, 92, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="background: rgba(255,255,255,0.2); padding: 0.75rem; border-radius: 10px;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 1rem;">Kelola Peminjaman</div>
                        <div style="font-size: 0.8rem; opacity: 0.8;">Review & approve booking</div>
                    </div>
                </a>

                <!-- Riwayat Peminjaman -->
                <a href="{{ route('admin.history.index') }}"
                    style="background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; padding: 1.25rem; border-radius: 12px; text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(184, 152, 95, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="background: rgba(255,255,255,0.2); padding: 0.75rem; border-radius: 10px;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 1rem;">Riwayat Peminjaman</div>
                        <div style="font-size: 0.8rem; opacity: 0.8;">Lihat semua riwayat</div>
                    </div>
                </a>

                <!-- Kelola Ruangan -->
                <a href="{{ route('admin.rooms.index') }}"
                    style="background: linear-gradient(135deg, #1a3a3a, #0d4d4d); color: white; padding: 1.25rem; border-radius: 12px; text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(26, 58, 58, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="background: rgba(184, 152, 95, 0.3); padding: 0.75rem; border-radius: 10px;">
                        <svg width="24" height="24" fill="none" stroke="#B8985F" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 1rem;">Kelola Ruangan</div>
                        <div style="font-size: 0.8rem; opacity: 0.8;">Tambah & edit ruangan</div>
                    </div>
                </a>

                <!-- Lihat Saran & Aspirasi -->
                <a href="{{ route('admin.aspirations.index') }}"
                    style="background: linear-gradient(135deg, #0d4d4d, #008B5C); color: white; padding: 1.25rem; border-radius: 12px; text-decoration: none; display: flex; align-items: center; gap: 1rem; transition: all 0.3s;"
                    onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 8px 25px rgba(0, 139, 92, 0.4)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <div style="background: rgba(255,255,255,0.2); padding: 0.75rem; border-radius: 10px;">
                        <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <div style="font-weight: 600; font-size: 1rem;">Saran & Aspirasi</div>
                        <div style="font-size: 0.8rem; opacity: 0.8;">Lihat masukan pengguna</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Logout Button -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                style="width: 100%; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; padding: 1rem; border: none; border-radius: 12px; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.3s; display: flex; align-items: center; justify-content: center; gap: 0.5rem;"
                onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(239, 68, 68, 0.4)'"
                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                Keluar dari Akun
            </button>
        </form>
    </div>
@endsection
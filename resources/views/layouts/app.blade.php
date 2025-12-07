<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin - Perpustakaan Unand')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- HEADER / NAVIGATION -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Perpustakaan" width="50">
                    <div class="logo-text">
                        <h1>Perpustakaan</h1>
                        <p>Universitas Andalas</p>
                    </div>
                </div>

                <nav class="navigation">
                    <ul class="nav-menu" id="navMenu">
                        {{-- Beranda --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.dashboard') }}" class="nav-link">Beranda</a>
                        </li>

                        {{-- Peminjaman Dropdown --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Peminjaman
                                <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('admin.rooms.index') }}" class="dropdown-item">Daftar Ruangan</a>
                                <a href="{{ route('admin.bookings.index') }}" class="dropdown-item">Daftar
                                    Peminjaman</a>
                                <a href="{{ route('admin.cancellations.index') }}" class="dropdown-item">Daftar
                                    Pembatalan</a>
                                <a href="{{ route('admin.closures.index') }}" class="dropdown-item">Penutupan
                                    Ruangan</a>
                            </div>
                        </li>

                        {{-- Informasi Dropdown --}}
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Informasi
                                <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('admin.terms.index') }}" class="dropdown-item">Syarat & Ketentuan</a>
                                <a href="{{ route('admin.booking-flow.index') }}" class="dropdown-item">Alur
                                    Peminjaman</a>
                                <a href="{{ route('admin.announcements.index') }}" class="dropdown-item">Pengumuman</a>
                                <a href="{{ route('admin.contacts.index') }}" class="dropdown-item">Kontak dan
                                    Layanan</a>
                            </div>
                        </li>

                        {{-- Riwayat --}}
                        <li class="nav-item">
                            <a href="{{ route('admin.history.index') }}" class="nav-link">Riwayat</a>
                        </li>

                        {{-- User Actions --}}
                        <li class="nav-item" style="display: flex; align-items: center; gap: 1rem; margin-left: auto;">
                            {{-- Notification Icon --}}
                            <a href="{{ route('admin.notifications') }}" class="icon-btn" aria-label="Notifikasi"
                                style="position: relative;">
                                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                @php
                                    $adminUnreadCount = \App\Models\Notification::where('user_id', auth()->id())->where('is_read', false)->count();
                                @endphp
                                @if($adminUnreadCount > 0)
                                    <span
                                        style="position: absolute; top: -4px; right: -4px; background: #ef4444; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700;">
                                        {{ $adminUnreadCount > 9 ? '9+' : $adminUnreadCount }}
                                    </span>
                                @endif
                            </a>

                            {{-- Profile Icon Link --}}
                            <a href="{{ route('admin.profile') }}" class="icon-btn" aria-label="Profile">
                                <svg width="28" height="28" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                    </path>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- MAIN CONTENT -->
    @yield('content')

    <!-- FOOTER (optional) -->
    @yield('footer')

    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
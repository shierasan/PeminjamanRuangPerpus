<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Dashboard') - Perpustakaan Unand</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .user-header {
            background: #FFF9E6;
            border-bottom: 1px solid #E6D5A8;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .user-nav-link {
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            color: #1a1a1a;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }

        .user-nav-link:hover,
        .user-nav-link.active {
            border-bottom-color: #B8985F;
        }

        .user-icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            border: 1px solid #E6D5A8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .user-icon-btn:hover {
            background: #f5f5f5;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <!-- User Header -->
    <header class="user-header">
        <div class="container">
            <div class="header-content" style="padding: 1rem 0;">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Perpustakaan" class="logo-img">
                    <div class="logo-text">
                        <h1>Perpustakaan</h1>
                        <p>Universitas Andalas</p>
                    </div>
                </div>

                <nav>
                    <ul class="nav-menu" style="align-items: center;">
                        <li class="nav-item">
                            <a href="{{ route('user.dashboard') }}"
                                class="user-nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                                Beranda
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.rooms') }}"
                                class="user-nav-link {{ request()->routeIs('user.rooms') ? 'active' : '' }}">
                                Peminjaman
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="user-nav-link">
                                Informasi
                                <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    width="16" height="16" style="display: inline; margin-left: 0.25rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ route('user.terms.index') }}" class="dropdown-item">Syarat & Ketentuan</a>
                                <a href="{{ route('public.booking-flow') }}" class="dropdown-item">Alur Peminjaman</a>
                                <a href="{{ route('user.announcements.index') }}" class="dropdown-item">Pengumuman</a>
                                <a href="{{ route('user.contacts.index') }}" class="dropdown-item">Kontak dan
                                    Layanan</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.history') }}" class="user-nav-link">Riwayat</a>
                        </li>

                        <!-- Right Side Icons -->
                        <li class="nav-item"
                            style="margin-left: auto; display: flex; gap: 0.75rem; align-items: center;">
                            <!-- Notification Bell -->
                            <a href="{{ route('user.notifications') }}" class="user-icon-btn" title="Notifikasi"
                                style="position: relative; text-decoration: none;">
                                <svg width="20" height="20" fill="none" stroke="#1a1a1a" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                                    </path>
                                </svg>
                                @php
                                    $unreadCount = \App\Models\Notification::where('user_id', auth()->id())->where('is_read', false)->count();
                                @endphp
                                @if($unreadCount > 0)
                                    <span
                                        style="position: absolute; top: -4px; right: -4px; background: #ef4444; color: white; border-radius: 50%; width: 18px; height: 18px; display: flex; align-items: center; justify-content: center; font-size: 0.65rem; font-weight: 700;">
                                        {{ $unreadCount > 9 ? '9+' : $unreadCount }}
                                    </span>
                                @endif
                            </a>

                            <!-- User Profile -->
                            <button class="user-icon-btn" title="Profile"
                                onclick="window.location.href='{{ route('user.profile') }}'">
                                <svg width="20" height="20" fill="none" stroke="#1a1a1a" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main style="background: white; min-height: calc(100vh - 80px);">
        @yield('content')
    </main>

    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
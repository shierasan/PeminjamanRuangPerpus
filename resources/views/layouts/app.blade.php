<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="@yield('meta_description', 'Sistem Peminjaman Ruangan Perpustakaan Universitas Andalas')">
    <title>@yield('title', 'Sistem Peminjaman Ruangan Perpustakaan')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- HEADER -->
    <header class="header" id="header">
        <div class="container">
            <div class="header-content">
                <!-- Logo -->
                <a href="/" class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Universitas Andalas" class="logo-img">
                    <div class="logo-text">
                        <h1>Perpustakaan</h1>
                        <p>Universitas Andalas</p>
                    </div>
                </a>

                <!-- Navigation -->
                <nav>
                    @yield('nav_toggle')

                    <ul class="nav-menu" id="navMenu">
                        <li class="nav-item">
                            <a href="/" class="nav-link">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="#peminjaman" class="nav-link">Peminjaman</a>
                        </li>
                        <li class="nav-item" id="informasiDropdown">
                            <a href="#" class="nav-link">
                                Informasi
                                <svg class="dropdown-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </a>
                            <div class="dropdown-menu">
                                <a href="#syarat" class="dropdown-item">Syarat & Ketentuan</a>
                                <a href="#alur" class="dropdown-item">Alur Peminjaman</a>
                                <a href="#pengumuman" class="dropdown-item">Pengumuman</a>
                                <a href="#kontak" class="dropdown-item">Kontak dan Layanan</a>
                            </div>
                        </li>

                        @yield('nav_items')
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
    <script src="{{ asset('js/auth.js') }}"></script>
    @yield('scripts')
</body>

</html>
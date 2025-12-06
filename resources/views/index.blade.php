<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Sistem peminjaman ruangan perpustakaan berbasis web untuk melihat ketersediaan, mengajukan reservasi, dan memantau status secara real-time.">
    <title>Sistem Peminjaman Ruangan Perpustakaan - Universitas Andalas</title>

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
                    <!-- Mobile Toggle -->
                    <div class="mobile-toggle" id="mobileToggle">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>

                    <ul class="nav-menu" id="navMenu">
                        <li class="nav-item">
                            <a href="#beranda" class="nav-link">Beranda</a>
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
                        <li class="nav-item">
                            <a href="/login" class="btn btn-primary">
                                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Login
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero" id="beranda">
        <div class="container">
            <div class="hero-content">
                <div class="hero-text">
                    <h1>
                        Sistem Peminjaman<br>
                        Ruangan Perpustakaan<br>
                        <span style="color: var(--color-teal);">Universitas Andalas</span>
                    </h1>
                    <p>
                        Sistem peminjaman ruangan perpustakaan berbasis web untuk melihat ketersediaan, mengajukan
                        reservasi, dan memantau status secara real-time.
                    </p>
                    <a href="#cara-kerja" class="btn btn-primary btn-lg">Mulai</a>
                </div>
                <div class="hero-image">
                    <img src="{{ asset('images/library-hero.jpg') }}" alt="Perpustakaan Universitas Andalas">
                </div>
            </div>
        </div>
    </section>

    <!-- INFORMASI TERBARU -->
    <section class="section">
        <div class="container">
            <h2 class="text-center">Informasi Terbaru</h2>
            <p class="text-center" style="color: var(--color-text-light);">
                Informasi terbaru seputar jadwal, kebijakan, dan pengumuman terkait peminjaman ruangan.
            </p>

            <div class="informasi-grid">
                <div class="card">
                    <p class="card-date">17 Nov 2025</p>
                    <h3 class="card-title">Maintenance Sistem</h3>
                    <p class="card-description">
                        Sistem peminjaman akan mengalami pemeliharaan pada Sabtu, 23 November 2025 pukul 18.00-21.00.
                        Selama periode ini layanan tidak dapat diakses.
                    </p>
                    <a href="#" class="card-link">
                        Baca selengkapnya
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="card">
                    <p class="card-date">17 Nov 2025</p>
                    <h3 class="card-title">Penutupan Sementara Migas Corner</h3>
                    <p class="card-description">
                        Ruang Migas Corner lantai 3 akan tutup untuk perawatan fasilitas hingga 27 November 2025.
                        Peminjaman akan dibuka kembali setelah perbaikan selesai.
                    </p>
                    <a href="#" class="card-link">
                        Baca selengkapnya
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <div class="card">
                    <p class="card-date">17 Nov 2025</p>
                    <h3 class="card-title">Aturan Baru Upload Surat Permohonan</h3>
                    <p class="card-description">
                        Mulai 1 Desember 2025, setiap peminjaman wajib melampirkan surat permohonan resmi dalam format
                        PDF sesuai ketentuan terbaru perpustakaan.
                    </p>
                    <a href="#" class="card-link">
                        Baca selengkapnya
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FITUR UTAMA -->
    <section class="section">
        <div class="container">
            <h2 class="text-center">Fitur Utama</h2>
            <p class="text-center" style="color: var(--color-text-light);">
                Fitur utama untuk cek jadwal, pinjam ruangan, pantau status, dan lihat informasi secara online.
            </p>

            <div class="fitur-grid">
                <div class="fitur-card">
                    <div class="fitur-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="fitur-title">Kalender Ketersediaan</h3>
                    <p class="fitur-desc">Lihat ketersediaan ruangan secara real-time.</p>
                </div>

                <div class="fitur-card">
                    <div class="fitur-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="fitur-title">Peminjaman Mudah</h3>
                    <p class="fitur-desc">Ajukan peminjaman ruangan secara online.</p>
                </div>

                <div class="fitur-card">
                    <div class="fitur-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="fitur-title">Pantau Status</h3>
                    <p class="fitur-desc">Cek status peminjaman dan notifikasi.</p>
                </div>

                <div class="fitur-card">
                    <div class="fitur-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="fitur-title">Informasi Ruangan</h3>
                    <p class="fitur-desc">Lihat detail ruangan dan fasilitasnya.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA -->
    <section class="section" id="cara-kerja">
        <div class="container">
            <h2 class="text-center">Cara Kerja</h2>
            <p class="text-center" style="color: var(--color-text-light);">
                Penjelasan langkah peminjaman dari login hingga konfirmasi.
            </p>

            <div class="cara-kerja-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                    </div>
                    <h3 class="step-title">Login</h3>
                    <p class="step-desc">Lihat ketersediaan ruangan secara real-time.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">2</div>
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 class="step-title">Cek Ketersediaan Ruangan</h3>
                    <p class="step-desc">Lihat jadwal dan slot waktu yang tersedia.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">3</div>
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="step-title">Ajukan Peminjaman</h3>
                    <p class="step-desc">Pilih ruangan, isi data, dan kirim permohonan.</p>
                </div>

                <div class="step-card">
                    <div class="step-number">4</div>
                    <div class="step-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="step-title">Konfirmasi</h3>
                    <p class="step-desc">Admin menyetujui atau menolak, dan pengaju menerima notifikasi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section section-alt">
        <div class="container">
            <h2 class="text-center">Frequently Ask Question (FAQ)</h2>
            <p class="text-center" style="color: var(--color-text-light);">
                Jawaban singkat untuk pertanyaan yang sering ditanyakan pengguna.
            </p>

            <div class="faq-container">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Bagaimana cara meminjam ruangan?</span>
                        <svg class="faq-toggle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Untuk meminjam ruangan, login terlebih dahulu menggunakan akun Anda. Kemudian pilih menu
                            Peminjaman, cek ketersediaan ruangan pada tanggal yang diinginkan, pilih ruangan dan waktu,
                            isi formulir peminjaman, dan kirim permohonan. Admin akan memproses permohonan Anda dan
                            mengirimkan notifikasi status.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Berapa lama proses persetujuan peminjaman?</span>
                        <svg class="faq-toggle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Proses persetujuan biasanya memakan waktu 1-3 hari kerja. Untuk permohonan yang mendesak,
                            Anda dapat menghubungi admin perpustakaan langsung melalui kontak yang tersedia di menu
                            Informasi.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Apakah bisa membatalkan peminjaman yang sudah disetujui?</span>
                        <svg class="faq-toggle" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Ya, Anda dapat membatalkan peminjaman yang sudah disetujui dengan menghubungi admin
                            perpustakaan minimal 24 jam sebelum waktu peminjaman. Pembatalan dapat dilakukan melalui
                            sistem atau dengan menghubungi admin langsung.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA SECTION -->
    <section class="cta-section">
        <div class="container">
            <h2>Ayo Gunakan Sistem Ini</h2>
            <p>Mulai pinjam ruangan Anda sekarang, lebih mudah dan praktis!</p>
            <div class="cta-buttons">
                <a href="#daftar" class="btn btn-secondary btn-lg">Daftar Sekarang</a>
                <a href="#fitur" class="btn btn-secondary btn-lg">Pelajari Lebih Lanjut</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-about">
                    <h3>TENTANG</h3>
                    <p>
                        Sistem peminjaman ruangan ini dibuat untuk mempermudah sivitas akademika dalam melihat
                        ketersediaan, memesan ruangan, dan memantau status peminjaman secara online dan real-time tanpa
                        proses manual.
                    </p>
                </div>
                <div class="footer-links">
                    <h3>LINK CEPAT</h3>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#fitur">Fitur</a></li>
                        <li><a href="#cara-kerja">Cara Kerja</a></li>
                        <li><a href="#faq">FAQ</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>2025 SISTEM BLA BLA by MPSI<br>Universitas Andalas</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>
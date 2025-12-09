<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPRUS - Sistem Peminjaman Ruang Pustaka</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo SIPRUS" class="logo-img">
                    <div class="logo-text">
                        <h1 style="color: #B8985F;">SIPRUS</h1>
                        <p style="font-size: 0.65rem;">Sistem Peminjaman Ruang Pustaka</p>
                    </div>
                </div>

                <nav>
                    <ul class="nav-menu">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a href="#peminjaman" class="nav-link">Peminjaman</a>
                        </li>
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
                                <a href="{{ route('public.terms') }}" class="dropdown-item">Syarat & Ketentuan</a>
                                <a href="#alur" class="dropdown-item">Alur Peminjaman</a>
                                <a href="#pengumuman" class="dropdown-item">Pengumuman</a>
                                <a href="{{ route('public.contacts') }}" class="dropdown-item">Kontak dan Layanan</a>
                            </div>
                        </li>
                        <li class="nav-item" style="margin-left: auto;">
                            <a href="{{ route('login') }}" class="btn btn-primary"
                                style="display: flex; align-items: center; gap: 0.5rem;">
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

    <!-- Hero Section -->
    <section style="background: #FFF9E6; padding: 5rem 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: center;">
                <div>
                    <h1
                        style="font-size: 3rem; font-weight: 700; line-height: 1.2; margin-bottom: 1.5rem; color: #1a1a1a;">
                        <span style="color: #B8985F;">SIPRUS</span><br>
                        Sistem Peminjaman
                        <span style="color: #008080;">Ruang Pustaka</span>
                    </h1>
                    <p style="font-size: 1.125rem; color: #666; line-height: 1.8; margin-bottom: 2rem;">
                        Sistem peminjaman ruangan perpustakaan berbasis web untuk melihat ketersediaan, mengajukan
                        reservasi, dan memantau status secara real-time.
                    </p>
                    <a href="#cara-kerja" class="btn btn-primary" style="font-size: 1.125rem; padding: 1rem 2.5rem;">
                        Mulai
                    </a>
                </div>
                <div>
                    <img src="{{ asset('images/library-hero.jpg') }}" alt="Perpustakaan"
                        style="width: 100%; height: 400px; object-fit: cover; border-radius: 50%; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </section>

    <!-- Informasi Terbaru -->
    <section id="pengumuman" style="padding: 5rem 0; background: white;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; text-align: center;">Informasi Terbaru
            </h2>
            <p style="text-align: center; color: #666; margin-bottom: 3rem;">
                Informasi terbaru seputar jadwal, kebijakan, dan pengumuman terkait peminjaman ruangan.
            </p>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                @forelse($announcements as $announcement)
                    <div style="background: #FFF9E6; padding: 2rem; border-radius: 12px; border: 1px solid #E6D5A8;">
                        <div style="font-size: 0.875rem; color: #B8985F; margin-bottom: 1rem;">
                            {{ $announcement->published_date->format('d M Y') }}
                        </div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">
                            {{ $announcement->title }}
                        </h3>
                        <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                            {{ Str::limit($announcement->content, 120) }}
                        </p>
                        <a href="{{ route('login') }}" style="color: #B8985F; font-weight: 600; text-decoration: none;">
                            Baca selengkapnya »
                        </a>
                    </div>
                @empty
                    <div style="grid-column: span 3; text-align: center; padding: 3rem; color: #666;">
                        <p>Belum ada pengumuman terbaru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Fitur Utama -->
    <section style="padding: 5rem 0; background: #FFF9E6;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; text-align: center;">Fitur Utama</h2>
            <p style="text-align: center; color: #666; margin-bottom: 3rem;">
                Fitur utama untuk cek jadwal, pinjam ruangan, pantau status, dan lihat informasi secara online.
            </p>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                <!-- Feature 1 -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 80px; height: 80px; background: #E8F5E9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="40" height="40" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.75rem; color: #008080;">
                        Kalender Ketersediaan
                    </h3>
                    <p style="color: #666; font-size: 0.875rem; line-height: 1.6;">
                        Cek ketersediaan ruangan secara real-time
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 80px; height: 80px; background: #E8F5E9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="40" height="40" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.75rem; color: #008080;">
                        Peminjaman Mudah
                    </h3>
                    <p style="color: #666; font-size: 0.875rem; line-height: 1.6;">
                        Ajukan peminjaman ruangan secara online
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 80px; height: 80px; background: #E8F5E9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="40" height="40" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.75rem; color: #008080;">
                        Pantau Status
                    </h3>
                    <p style="color: #666; font-size: 0.875rem; line-height: 1.6;">
                        Cek status pengajuan dan notifikasi
                    </p>
                </div>

                <!-- Feature 4 -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">
                    <div
                        style="width: 80px; height: 80px; background: #E8F5E9; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                        <svg width="40" height="40" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                    </div>
                    <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.75rem; color: #008080;">
                        Informasi Ruangan
                    </h3>
                    <p style="color: #666; font-size: 0.875rem; line-height: 1.6;">
                        Lihat detail ruangan dan fasilitas lengkap
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section id="cara-kerja" style="padding: 5rem 0; background: white;">
        <div class="container">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; text-align: center;">Cara Kerja</h2>
            <p style="text-align: center; color: #666; margin-bottom: 3rem;">
                Penjelasan langkah peminjaman dari login hingga konfirmasi.
            </p>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                <!-- Step 1 -->
                <div style="background: #B8985F; border-radius: 12px; overflow: hidden;">
                    <div style="background: #9d7d4b; padding: 1.5rem; text-align: center;">
                        <h3 style="font-size: 2.5rem; font-weight: 700; color: white;">1</h3>
                    </div>
                    <div
                        style="background: #FFF9E6; padding: 2rem; text-align: center; min-height: 200px; display: flex; flex-direction: column; justify-content: center;">
                        <div
                            style="width: 60px; height: 60px; background: #B8985F; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="30" height="30" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                                </path>
                            </svg>
                        </div>
                        <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">Login</h4>
                        <p style="color: #666; font-size: 0.875rem;">
                            Lihat ketersediaan ruangan secara real-time
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div style="background: #B8985F; border-radius: 12px; overflow: hidden;">
                    <div style="background: #9d7d4b; padding: 1.5rem; text-align: center;">
                        <h3 style="font-size: 2.5rem; font-weight: 700; color: white;">2</h3>
                    </div>
                    <div
                        style="background: #FFF9E6; padding: 2rem; text-align: center; min-height: 200px; display: flex; flex-direction: column; justify-content: center;">
                        <div
                            style="width: 60px; height: 60px; background: #B8985F; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="30" height="30" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">Cek Ketersediaan
                            Ruangan</h4>
                        <p style="color: #666; font-size: 0.875rem;">
                            Lihat jadwal dan slot waktu yang tersedia
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div style="background: #B8985F; border-radius: 12px; overflow: hidden;">
                    <div style="background: #9d7d4b; padding: 1.5rem; text-align: center;">
                        <h3 style="font-size: 2.5rem; font-weight: 700; color: white;">3</h3>
                    </div>
                    <div
                        style="background: #FFF9E6; padding: 2rem; text-align: center; min-height: 200px; display: flex; flex-direction: column; justify-content: center;">
                        <div
                            style="width: 60px; height: 60px; background: #B8985F; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="30" height="30" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">Ajukan Peminjaman</h4>
                        <p style="color: #666; font-size: 0.875rem;">
                            Pilih ruangan, isi data, dan kirim permohonan
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div style="background: #B8985F; border-radius: 12px; overflow: hidden;">
                    <div style="background: #9d7d4b; padding: 1.5rem; text-align: center;">
                        <h3 style="font-size: 2.5rem; font-weight: 700; color: white;">4</h3>
                    </div>
                    <div
                        style="background: #FFF9E6; padding: 2rem; text-align: center; min-height: 200px; display: flex; flex-direction: column; justify-content: center;">
                        <div
                            style="width: 60px; height: 60px; background: #B8985F; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                            <svg width="30" height="30" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">Konfirmasi</h4>
                        <p style="color: #666; font-size: 0.875rem;">
                            Admin menyetujui atau menolak, dan pengajuan menerima notifikasi
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section style="padding: 5rem 0; background: #FFF9E6;">
        <div class="container" style="max-width: 800px;">
            <h2 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; text-align: center;">Frequently Ask
                Question (FAQ)</h2>
            <p style="text-align: center; color: #666; margin-bottom: 3rem;">
                Jawaban singkat untuk pertanyaan yang sering ditanyakan pengguna.
            </p>

            <div style="display: flex; flex-direction: column; gap: 1rem;">
                <!-- FAQ 1 -->
                <div style="background: white; border-radius: 12px; border: 1px solid #E6D5A8;">
                    <button onclick="toggleFAQ(1)"
                        style="width: 100%; padding: 1.5rem; text-align: left; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; font-size: 1.125rem;">Bagaimana cara melakukan peminjaman
                            ruangan?</span>
                        <svg id="faq-icon-1" width="24" height="24" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" style="transition: transform 0.3s;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-content-1" style="display: none; padding: 0 1.5rem 1.5rem;">
                        <p style="color: #666; line-height: 1.6;">
                            Login ke sistem, pilih ruangan yang tersedia, isi form peminjaman dengan lengkap, upload
                            surat permohonan, dan kirim. Admin akan meninjau dan memberikan konfirmasi.
                        </p>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div style="background: white; border-radius: 12px; border: 1px solid #E6D5A8;">
                    <button onclick="toggleFAQ(2)"
                        style="width: 100%; padding: 1.5rem; text-align: left; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; font-size: 1.125rem;">Berapa lama waktu konfirmasi
                            peminjaman?</span>
                        <svg id="faq-icon-2" width="24" height="24" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" style="transition: transform 0.3s;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-content-2" style="display: none; padding: 0 1.5rem 1.5rem;">
                        <p style="color: #666; line-height: 1.6;">
                            Biasanya admin akan merespon dalam 1-2 hari kerja. Anda akan menerima notifikasi email saat
                            pengajuan disetujui atau ditolak.
                        </p>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div style="background: white; border-radius: 12px; border: 1px solid #E6D5A8;">
                    <button onclick="toggleFAQ(3)"
                        style="width: 100%; padding: 1.5rem; text-align: left; background: none; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-weight: 600; font-size: 1.125rem;">Apakah bisa membatalkan peminjaman?</span>
                        <svg id="faq-icon-3" width="24" height="24" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" style="transition: transform 0.3s;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>
                    <div id="faq-content-3" style="display: none; padding: 0 1.5rem 1.5rem;">
                        <p style="color: #666; line-height: 1.6;">
                            Ya, Anda bisa mengajukan pembatalan melalui menu pembatalan. Pembatalan direkomendasikan
                            minimal H-2 agar ruangan dapat digunakan oleh yang lain.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section style="padding: 5rem 0; background: linear-gradient(135deg, #B8985F, #9d7d4b);">
        <div class="container" style="text-align: center;">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: white; margin-bottom: 1rem;">
                Ayo Gunakan Sistem Ini
            </h2>
            <p style="font-size: 1.125rem; color: rgba(255,255,255,0.9); margin-bottom: 2.5rem;">
                Mulai pinjam ruangan Anda sekarang, lebih mudah dan praktis!
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="{{ route('login') }}" class="btn"
                    style="background: white; color: #B8985F; padding: 1rem 2.5rem; font-size: 1.125rem; font-weight: 600;">
                    Daftar Sekarang
                </a>
                <a href="#cara-kerja" class="btn"
                    style="background: transparent; color: white; border: 2px solid white; padding: 1rem 2.5rem; font-size: 1.125rem; font-weight: 600;">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer style="background: #1F2937; padding: 3rem 0; color: white;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 4rem;">
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: white;">TENTANG</h3>
                    <p style="color: #9CA3AF; line-height: 1.8;">
                        Sistem peminjaman ruangan ini dibuat untuk mempermudah sivitas akademika dalam melihat
                        ketersediaan, mengajukan reservasi ruangan, dan memantau status peminjaman secara online dan
                        real-time tanpa proses manual.
                    </p>
                </div>
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: white;">LINK CEPAT</h3>
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        <li style="margin-bottom: 0.75rem;">
                            <a href="#" style="color: #9CA3AF; text-decoration: none;">Beranda</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="#" style="color: #9CA3AF; text-decoration: none;">Fitur</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="#cara-kerja" style="color: #9CA3AF; text-decoration: none;">Cara Kerja</a>
                        </li>
                        <li style="margin-bottom: 0.75rem;">
                            <a href="#" style="color: #9CA3AF; text-decoration: none;">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <script>
        function toggleFAQ(id) {
            const content = document.getElementById('faq-content-' + id);
            const icon = document.getElementById('faq-icon-' + id);

            if (content.style.display === 'none') {
                content.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            } else {
                content.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>
</body>

</html>
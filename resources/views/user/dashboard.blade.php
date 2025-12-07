@extends('layouts.user')

@section('title', 'Beranda')

@section('content')
    <div class="container" style="padding: 3rem 0;">

        <!-- Informasi Terbaru Section -->
        <section style="margin-bottom: 4rem;">
            <h2 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Informasi Terbaru</h2>
            <p style="color: #666; margin-bottom: 2rem;">
                Informasi terbaru seputar jadwal, kebijakan, dan pengumuman terkait peminjaman ruangan.
            </p>

            @if($announcements->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                    @foreach($announcements as $announcement)
                        <div style="background: #FFF9E6; padding: 2rem; border-radius: 12px; border: 1px solid #E6D5A8;">
                            <div style="font-size: 0.875rem; color: #B8985F; margin-bottom: 1rem;">
                                {{ \Carbon\Carbon::parse($announcement->published_date)->format('d M Y') }}
                            </div>
                            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">
                                {{ $announcement->title }}
                            </h3>
                            <p style="color: #666; line-height: 1.6; margin-bottom: 1.5rem;">
                                {{ Str::limit($announcement->content, 150) }}
                            </p>
                            <a href="#" style="color: #B8985F; font-weight: 600; text-decoration: none;">
                                Baca selengkapnya »
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 3rem; background: #f9f9f9; border-radius: 12px;">
                    <p style="color: #999;">Belum ada pengumuman terbaru.</p>
                </div>
            @endif
        </section>

        <!-- Fitur Utama Section -->
        <section style="margin-bottom: 4rem;">
            <h2 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Fitur Utama</h2>
            <p style="color: #666; margin-bottom: 2rem;">
                Fitur utama untuk cek jadwal, pinjam ruangan, pantau status, dan lihat informasi secara online.
            </p>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                <!-- Feature 1 - Kalender -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
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

                <!-- Feature 2 - Peminjaman -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
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

                <!-- Feature 3 - Pantau Status -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
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

                <!-- Feature 4 - Informasi Ruangan -->
                <div
                    style="background: white; padding: 2rem; border-radius: 12px; text-align: center; box-shadow: 0 2px 8px rgba(0,0,0,0.05); border: 1px solid #f0f0f0;">
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
        </section>

        <!-- Cara Kerja Section -->
        <section style="margin-bottom: 4rem;">
            <h2 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 0.5rem;">Cara Kerja</h2>
            <p style="color: #666; margin-bottom: 2rem;">
                Penjelasan langkah peminjaman dari login hingga konfirmasi.
            </p>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                <!-- Step 1 - Login -->
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

                <!-- Step 2 - Cek Ketersediaan -->
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
                        <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 0.5rem;">Cek Ketersediaan Ruangan
                        </h4>
                        <p style="color: #666; font-size: 0.875rem;">
                            Lihat jadwal dan slot waktu yang tersedia
                        </p>
                    </div>
                </div>

                <!-- Step 3 - Ajukan Peminjaman -->
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

                <!-- Step 4 - Konfirmasi -->
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
        </section>
    </div>
@endsection
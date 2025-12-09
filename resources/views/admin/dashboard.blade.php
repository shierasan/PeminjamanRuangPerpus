@extends('layouts.app')

@section('title', 'Dashboard Admin - SIPRUS')

@section('content')
    <!-- ADMIN DASHBOARD SECTION -->
    <section class="section" style="padding-top: 3rem;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 1rem;">Dashboard Admin</h2>
            <p style="text-align: center; color: var(--color-text-light); margin-bottom: 3rem;">
                Kelola peminjaman ruangan perpustakaan dengan mudah
            </p>

            <!-- Statistics Cards -->
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
                <div class="card" style="text-align: center;">
                    <div
                        style="width: 64px; height: 64px; background-color: rgba(184, 152, 95, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <svg width="32" height="32" fill="none" stroke="var(--color-primary)" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 style="font-size: 2.5rem; font-weight: 700; color: var(--color-dark); margin-bottom: 0.5rem;">
                        {{ $stats['total_bookings'] }}</h3>
                    <p style="color: var(--color-text-light); font-size: 0.875rem;">Total Peminjaman</p>
                </div>

                <div class="card" style="text-align: center;">
                    <div
                        style="width: 64px; height: 64px; background-color: rgba(245, 158, 11, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <svg width="32" height="32" fill="none" stroke="var(--color-warning)" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 2.5rem; font-weight: 700; color: var(--color-dark); margin-bottom: 0.5rem;">
                        {{ $stats['pending_bookings'] }}</h3>
                    <p style="color: var(--color-text-light); font-size: 0.875rem;">Menunggu Persetujuan</p>
                </div>

                <div class="card" style="text-align: center;">
                    <div
                        style="width: 64px; height: 64px; background-color: rgba(16, 185, 129, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <svg width="32" height="32" fill="none" stroke="var(--color-success)" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 2.5rem; font-weight: 700; color: var(--color-dark); margin-bottom: 0.5rem;">
                        {{ $stats['approved_bookings'] }}</h3>
                    <p style="color: var(--color-text-light); font-size: 0.875rem;">Disetujui</p>
                </div>

                <div class="card" style="text-align: center;">
                    <div
                        style="width: 64px; height: 64px; background-color: rgba(239, 68, 68, 0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <svg width="32" height="32" fill="none" stroke="#EF4444" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 style="font-size: 2.5rem; font-weight: 700; color: var(--color-dark); margin-bottom: 0.5rem;">
                        {{ $stats['rejected_bookings'] }}</h3>
                    <p style="color: var(--color-text-light); font-size: 0.875rem;">Ditolak</p>
                </div>
            </div>

            <!-- Pending Bookings -->
            @if($pending_bookings->count() > 0)
                <div class="card" style="margin-bottom: 3rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h3 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Peminjaman Menunggu Persetujuan</h3>
                        <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}" class="btn btn-primary btn-sm">
                            Lihat Semua
                        </a>
                    </div>

                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #F9FAFB; border-bottom: 2px solid #E5E7EB;">
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Tanggal</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Peminjam</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Ruangan</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Waktu</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Status</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pending_bookings as $booking)
                                    <tr style="border-bottom: 1px solid #E5E7EB; transition: background-color 0.2s;"
                                        onmouseover="this.style.backgroundColor='#F9FAFB'"
                                        onmouseout="this.style.backgroundColor=''">
                                        <td style="padding: 1rem; color: var(--color-text);">
                                            {{ $booking->booking_date->format('d M Y') }}</td>
                                        <td style="padding: 1rem; color: var(--color-text);">{{ $booking->user->name }}</td>
                                        <td style="padding: 1rem; font-weight: 600; color: var(--color-dark);">
                                            {{ $booking->room->name }}</td>
                                        <td style="padding: 1rem; color: var(--color-text);">
                                            {{ date('H:i', strtotime($booking->start_time)) }} -
                                            {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                        <td style="padding: 1rem;">
                                            <span
                                                style="display: inline-flex; padding: 0.25rem 0.75rem; background-color: rgba(245, 158, 11, 0.1); color: var(--color-warning); border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                                                Pending
                                            </span>
                                        </td>
                                        <td style="padding: 1rem;">
                                            <a href="{{ route('admin.bookings.show', $booking) }}"
                                                class="btn btn-primary btn-sm">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <!-- Today's Bookings -->
            <div class="card">
                <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">Peminjaman Hari Ini</h3>

                @if($today_bookings->count() > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="background-color: #F9FAFB; border-bottom: 2px solid #E5E7EB;">
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Ruangan</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Peminjam</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Waktu</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Nama Kegiatan</th>
                                    <th
                                        style="padding: 1rem; text-align: left; font-size: 0.875rem; font-weight: 600; color: var(--color-dark);">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($today_bookings as $booking)
                                    <tr style="border-bottom: 1px solid #E5E7EB; transition: background-color 0.2s;"
                                        onmouseover="this.style.backgroundColor='#F9FAFB'"
                                        onmouseout="this.style.backgroundColor=''">
                                        <td style="padding: 1rem; font-weight: 600; color: var(--color-dark);">
                                            {{ $booking->room->name }}</td>
                                        <td style="padding: 1rem; color: var(--color-text);">{{ $booking->user->name }}</td>
                                        <td style="padding: 1rem; color: var(--color-text);">
                                            {{ date('H:i', strtotime($booking->start_time)) }} -
                                            {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                        <td style="padding: 1rem; color: var(--color-text);">{{ Str::limit($booking->event_name ?? '-', 50) }}
                                        </td>
                                        <td style="padding: 1rem;">
                                            <span
                                                style="display: inline-flex; padding: 0.25rem 0.75rem; background-color: rgba(16, 185, 129, 0.1); color: var(--color-success); border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-transform: uppercase;">
                                                Disetujui
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="padding: 3rem; text-align: center; color: #9CA3AF;">
                        <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="margin: 0 auto 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                            </path>
                        </svg>
                        <p>Tidak ada peminjaman untuk hari ini</p>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('scripts')
    <script>
        // Add dropdown functionality for peminjaman if not already exists
        document.addEventListener('DOMContentLoaded', function () {
            const peminjamanDropdown = document.getElementById('peminjamanDropdown');
            if (peminjamanDropdown) {
                peminjamanDropdown.addEventListener('click', function (e) {
                    e.preventDefault();
                    this.classList.toggle('active');
                });
            }

            const profileDropdown = document.getElementById('profileDropdown');
            if (profileDropdown) {
                profileDropdown.addEventListener('click', function (e) {
                    e.preventDefault();
                    this.classList.toggle('active');
                });
            }
        });
    </script>
@endsection

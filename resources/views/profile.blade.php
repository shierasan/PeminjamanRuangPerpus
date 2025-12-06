@extends('layouts.app')

@section('title', 'Profile - Sistem Peminjaman Ruangan Perpustakaan')
@section('meta_description', 'Profile - Sistem Peminjaman Ruangan Perpustakaan Universitas Andalas')

@section('nav_items')
    <li class="nav-item">
        <a href="#riwayat" class="nav-link">Riwayat</a>
    </li>
    <!-- Notification Icon -->
    <li class="nav-item">
        <button class="icon-btn" id="notificationBtn">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                </path>
            </svg>
        </button>
    </li>
    <!-- User Profile Icon -->
    <li class="nav-item">
        <button class="icon-btn" id="profileBtn">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                </path>
            </svg>
        </button>
    </li>
@endsection

@section('content')
    <!-- PROFILE CONTENT -->
    <section class="profile-section">
        <div class="container">
            <div class="profile-container">
                <h1>Profile</h1>

                <!-- User Info Card -->
                <div class="profile-card">
                    <div class="profile-info">
                        <div class="profile-avatar">
                            <svg width="48" height="48" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                            </svg>
                        </div>
                        <div class="profile-details">
                            <h3 id="userName">Wanda Hamidah</h3>
                            <p id="userEmail">wanda_231523071@student.unand.ac.id</p>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="profile-actions-card">
                    <h3>Aksi Cepat</h3>
                    <div class="profile-actions">
                        <a href="#riwayat" class="profile-action-btn">Riwayat Peminjaman</a>
                        <a href="#password" class="profile-action-btn">Ubah Password</a>
                        <a href="#saran" class="profile-action-btn">Kirim Saran & Aspirasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
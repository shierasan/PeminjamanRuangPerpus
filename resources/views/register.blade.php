@extends('layouts.auth')

@section('title', 'Sign Up - Sistem Peminjaman Ruangan Perpustakaan')
@section('meta_description', 'Daftar Akun - Sistem Peminjaman Ruangan Perpustakaan Universitas Andalas')

@section('auth_left_description')
    Buat akun baru dan nikmati kemudahan dalam memesan ruangan secara online.
@endsection

@section('content')
    <h2>Daftar Akun</h2>
    <p class="auth-subtitle">Buat akun baru dan nikmati kemudahan dalam memesan ruangan secara online.</p>

    <form id="registerForm" class="auth-form">
        <!-- Nama -->
        <div class="form-group">
            <label for="nama">Nama</label>
            <div class="input-with-icon">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
                <input type="text" id="nama" name="nama" placeholder="masukkan nama lengkap" required>
            </div>
        </div>

        <!-- Kontak -->
        <div class="form-group">
            <label for="kontak">Kontak</label>
            <div class="input-with-icon">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                    </path>
                </svg>
                <input type="tel" id="kontak" name="kontak" placeholder="masukkan nomor telepon" required>
            </div>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-with-icon">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                    </path>
                </svg>
                <input type="email" id="email" name="email" placeholder="masukkan email pribadi/instansi" required>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-with-icon">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                <input type="password" id="password" name="password" placeholder="minimal 8 karakter" required>
            </div>
        </div>

        <!-- Konfirmasi Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="input-with-icon">
                <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    placeholder="ulangin password" required>
            </div>
        </div>

        <!-- Sign Up Button -->
        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>

        <!-- Login Link -->
        <p class="auth-footer">
            Sudah punya akun? <a href="{{ url('/login') }}" class="auth-link">Masuk sekarang</a>
        </p>
    </form>
@endsection
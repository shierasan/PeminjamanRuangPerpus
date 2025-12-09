@extends('layouts.auth')

@section('title', 'Login - SIPRUS')
@section('meta_description', 'Login - SIPRUS Universitas Andalas')

@section('auth_left_description')
    Platform reservasi ruangan perpustakaan Universitas Andalas yang modern, cepat, dan mudah digunakan.
@endsection

@section('content')
    <div class="auth-form-header">
        <h2>Selamat Datang! 👋</h2>
        <p>Masuk ke akun Anda untuk melanjutkan</p>
    </div>

    <form id="loginForm" class="modern-form">
        @csrf
        <!-- Email -->
        <div class="form-group">
            <label for="email">Email</label>
            <div class="modern-input-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
                <input type="email" id="email" name="email" class="modern-input" placeholder="nama@email.com" required>
            </div>
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password">Password</label>
            <div class="modern-input-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                <input type="password" id="password" name="password" class="modern-input" placeholder="••••••••" required>
                <button type="button" class="password-toggle" onclick="togglePassword()">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Remember & Forgot -->
        <div class="form-options-row">
            <label class="remember-check">
                <input type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>
            <a href="#" class="forgot-password">Lupa Password?</a>
        </div>

        <!-- Login Button -->
        <button type="submit" class="btn-login">Masuk</button>

        <!-- Divider -->
        <div class="divider">
            <span>atau masuk dengan</span>
        </div>

        <!-- SSO Button -->
        <button type="button" class="btn-sso-unand">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path
                    d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
                <path
                    d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" />
                <path
                    d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" />
                <path
                    d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" />
            </svg>
            Universitas Andalas eMail
        </button>

        <!-- Sign Up Link -->
        <p class="register-link">
            Belum punya akun? <a href="{{ url('/register') }}">Daftar Sekarang</a>
        </p>
    </form>
@endsection
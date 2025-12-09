@extends('layouts.auth')

@section('title', 'Daftar - SIPRUS')
@section('meta_description', 'Daftar akun baru - SIPRUS Universitas Andalas')

@section('auth_left_description')
    Bergabung dengan ribuan pengguna SIPRUS untuk kemudahan reservasi ruangan perpustakaan.
@endsection

@section('content')
    <div class="auth-form-header">
        <h2>Buat Akun Baru 🎉</h2>
        <p>Daftar untuk mulai menggunakan layanan SIPRUS</p>
    </div>

    <form id="registerForm" class="modern-form" method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div class="form-group">
            <label for="name">Nama Lengkap</label>
            <div class="modern-input-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
                <input type="text" id="name" name="name" class="modern-input" placeholder="Nama lengkap Anda" required>
            </div>
        </div>

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
                <input type="password" id="password" name="password" class="modern-input" placeholder="Minimal 6 karakter"
                    required>
                <button type="button" class="password-toggle" onclick="togglePassword('password')">
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

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password</label>
            <div class="modern-input-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                    </path>
                </svg>
                <input type="password" id="password_confirmation" name="password_confirmation" class="modern-input"
                    placeholder="Ulangi password" required>
                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
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

        <!-- Register Button -->
        <button type="submit" class="btn-login">Daftar Sekarang</button>

        <!-- Sign In Link -->
        <p class="register-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </form>
@endsection

@section('scripts')
    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }

        document.getElementById('registerForm').addEventListener('submit', async function (e) {
            e.preventDefault();

            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.textContent;
            submitBtn.disabled = true;
            submitBtn.textContent = 'Memproses...';

            try {
                const formData = new FormData(this);
                const data = {};
                formData.forEach((value, key) => {
                    data[key] = value;
                });

                const response = await fetch('/register', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': data._token,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    alert(result.message);
                    window.location.href = result.redirect;
                } else if (result.errors) {
                    const errorMessages = Object.values(result.errors).flat().join('\n');
                    alert('Validasi gagal:\n' + errorMessages);
                } else {
                    alert(result.message || 'Terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan. Silakan coba lagi.');
            } finally {
                submitBtn.disabled = false;
                submitBtn.textContent = originalText;
            }
        });
    </script>
@endsection
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'SIPRUS - Sistem Peminjaman Ruang Pustaka')">
    <title>@yield('title', 'SIPRUS - Sistem Peminjaman Ruang Pustaka')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .auth-page {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #FFF9E6;
        }

        /* Left Side - Gold/Teal Theme */
        .auth-left-panel {
            background: linear-gradient(135deg, #1a3a3a 0%, #0d4d4d 40%, #008B5C 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .auth-left-panel::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 400px;
            height: 400px;
            background: rgba(184, 152, 95, 0.1);
            border-radius: 50%;
        }

        .auth-left-panel::after {
            content: '';
            position: absolute;
            bottom: -150px;
            left: -100px;
            width: 500px;
            height: 500px;
            background: rgba(184, 152, 95, 0.08);
            border-radius: 50%;
        }

        .auth-brand {
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .auth-logo-img {
            width: 120px;
            height: auto;
            margin: 0 auto 2rem;
            filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.3));
        }

        .auth-brand h1 {
            color: #B8985F;
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .auth-brand h2 {
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .auth-brand .highlight {
            color: #B8985F;
        }

        .auth-brand p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1rem;
            line-height: 1.7;
            max-width: 400px;
            margin: 1.5rem auto 0;
        }

        /* Feature badges */
        .feature-badges {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }

        .feature-badge {
            background: rgba(184, 152, 95, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.75rem 1.25rem;
            border-radius: 50px;
            color: #B8985F;
            font-size: 0.85rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            border: 1px solid rgba(184, 152, 95, 0.3);
        }

        /* Right Side - Form */
        .auth-right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            background: white;
        }

        .auth-form-wrapper {
            width: 100%;
            max-width: 450px;
        }

        .auth-form-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .auth-form-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .auth-form-header p {
            color: #666;
            font-size: 0.95rem;
        }

        /* Modern Form Styles */
        .modern-form .form-group {
            margin-bottom: 1.5rem;
        }

        .modern-form label {
            display: block;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .modern-input-wrapper {
            position: relative;
        }

        .modern-input-wrapper svg {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            color: #B8985F;
            pointer-events: none;
        }

        .modern-input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #E6D5A8;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s;
            background: #FFF9E6;
        }

        .modern-input:focus {
            outline: none;
            border-color: #B8985F;
            box-shadow: 0 0 0 4px rgba(184, 152, 95, 0.15);
            background: white;
        }

        .modern-input::placeholder {
            color: #aaa;
        }

        .password-toggle {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #B8985F;
            padding: 0.25rem;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: #008B5C;
        }

        .form-options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: #666;
            cursor: pointer;
        }

        .remember-check input {
            width: 18px;
            height: 18px;
            accent-color: #008B5C;
        }

        .forgot-password {
            color: #008B5C;
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-password:hover {
            color: #006B47;
        }

        /* Buttons */
        .btn-login {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #B8985F, #9d7d4b);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-bottom: 1rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(184, 152, 95, 0.4);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #E6D5A8;
        }

        .divider span {
            padding: 0 1rem;
        }

        .btn-sso-unand {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #008B5C, #006B47);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        .btn-sso-unand:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 139, 92, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.95rem;
        }

        .register-link a {
            color: #008B5C;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .register-link a:hover {
            color: #006B47;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .auth-page {
                grid-template-columns: 1fr;
            }

            .auth-left-panel {
                padding: 2rem;
                min-height: auto;
            }

            .auth-brand h1 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .auth-right-panel {
                padding: 1.5rem;
            }

            .feature-badges {
                display: none;
            }
        }
    </style>
</head>

<body>
    <div class="auth-page">
        <!-- LEFT SIDE - Branding -->
        <div class="auth-left-panel">
            <div class="auth-brand">
                <img src="{{ asset('images/logo.png') }}" alt="Logo SIPRUS" class="auth-logo-img">
                <h1>SIPRUS</h1>
                <h2>Sistem Peminjaman <span class="highlight">Ruang Pustaka</span></h2>
                <p>@yield('auth_left_description', 'Platform reservasi ruangan perpustakaan Universitas Andalas yang modern, cepat, dan mudah digunakan.')
                </p>

                <div class="feature-badges">
                    <div class="feature-badge">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Real-time
                    </div>
                    <div class="feature-badge">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Aman
                    </div>
                    <div class="feature-badge">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Cepat
                    </div>
                </div>
            </div>
        </div>

        <!-- RIGHT SIDE - Form -->
        <div class="auth-right-panel">
            <div class="auth-form-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/auth.js') }}"></script>
    @yield('scripts')
</body>

</html>
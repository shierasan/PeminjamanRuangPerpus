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
    <div class="auth-container">
        <!-- LEFT SIDE - Gold Gradient -->
        <div class="auth-left">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Universitas Andalas" class="auth-logo">

            <div class="auth-left-content">
                <h1>
                    Sistem Peminjaman<br>
                    Ruangan Perpustakaan<br>
                    <span class="text-teal">Universitas Andalas</span>
                </h1>
                <p>@yield('auth_left_description')</p>
            </div>
        </div>

        <!-- RIGHT SIDE - White Form -->
        <div class="auth-right">
            <div class="auth-form-container">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="{{ asset('js/auth.js') }}"></script>
</body>

</html>
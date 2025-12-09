<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="300"> <!-- Auto refresh every 5 minutes -->
    <title>@yield('title', 'Display Monitor - SIPRUS')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-primary: #B8985F;
            --color-primary-dark: #9A7D4D;
            --color-primary-light: #D4B885;
            --color-teal: #008B5C;
            --color-teal-dark: #006B47;
            --color-secondary: #F5F1E8;
            --color-dark: #1F2937;
            --color-darker: #111827;
            --color-text: #374151;
            --color-text-light: #6B7280;
            --color-white: #FFFFFF;
            --color-success: #10B981;
            --color-warning: #F59E0B;
            --color-danger: #ef4444;
            --color-info: #3b82f6;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-secondary);
            min-height: 100vh;
            color: var(--color-text);
            overflow-x: hidden;
        }

        .display-header {
            background-color: var(--color-secondary);
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid var(--color-primary);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .display-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .display-logo img {
            width: 48px;
            height: 48px;
        }

        .display-logo-text {
            font-size: 1.5rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            color: var(--color-primary);
        }

        .display-logo-subtitle {
            font-size: 0.75rem;
            color: var(--color-text-light);
            font-weight: 400;
        }

        .display-time {
            text-align: right;
        }

        .current-time {
            font-size: 2rem;
            font-weight: 700;
            font-variant-numeric: tabular-nums;
            color: var(--color-dark);
        }

        .current-date {
            font-size: 0.875rem;
            color: var(--color-text-light);
        }

        .display-content {
            padding: 2rem;
            min-height: calc(100vh - 100px);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease forwards;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        .pulse {
            animation: pulse 2s ease-in-out infinite;
        }
    </style>
    @yield('styles')
</head>

<body>
    <header class="display-header">
        <div class="display-logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" onerror="this.style.display='none'">
            <div>
                <div class="display-logo-text">SIPRUS</div>
                <div class="display-logo-subtitle">Sistem Peminjaman Ruang Pustaka</div>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 2rem;"
            onmouseenter="document.getElementById('logoutBtn').style.opacity='1'"
            onmouseleave="document.getElementById('logoutBtn').style.opacity='0'">
            <div class="display-time">
                <div class="current-time" id="currentTime">--:--:--</div>
                <div class="current-date" id="currentDate">Loading...</div>
            </div>
            <form action="{{ route('logout') }}" method="POST" id="logoutBtn"
                style="opacity: 0; transition: opacity 0.3s ease;">
                @csrf
                <button type="submit"
                    style="background: var(--color-danger); border: none; color: white; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer; font-weight: 600; font-size: 0.75rem; display: flex; align-items: center; gap: 0.5rem; transition: all 0.2s;"
                    onmouseover="this.style.background='#dc2626'"
                    onmouseout="this.style.background='var(--color-danger)'">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                        </path>
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </header>

    <main class="display-content">
        @yield('content')
    </main>

    <script>
        function updateTime() {
            const now = new Date();
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
            const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };

            document.getElementById('currentTime').textContent = now.toLocaleTimeString('id-ID', timeOptions);
            document.getElementById('currentDate').textContent = now.toLocaleDateString('id-ID', dateOptions);
        }

        updateTime();
        setInterval(updateTime, 1000);
    </script>
    @yield('scripts')
</body>

</html>
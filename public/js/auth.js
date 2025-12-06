// ============================================
// AUTHENTICATION STATE MANAGEMENT
// ============================================

// Auto-logout on page load (clear authentication state)
// This ensures the web always starts in a logged-out state
if (!sessionStorage.getItem('pageVisited')) {
    // First time visiting in this session - clear auth
    localStorage.removeItem('user');
    sessionStorage.setItem('pageVisited', 'true');
}

// Check authentication state on page load
document.addEventListener('DOMContentLoaded', function () {
    checkAuthState();

    // Login Form Handler
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }

    // Register Form Handler
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', handleRegister);
    }

    // Profile Button Handler
    const profileBtn = document.getElementById('profileBtn');
    if (profileBtn) {
        profileBtn.addEventListener('click', function () {
            window.location.href = '/profile';
        });
    }

    // Notification Button Handler (placeholder)
    const notificationBtn = document.getElementById('notificationBtn');
    if (notificationBtn) {
        notificationBtn.addEventListener('click', function () {
            alert('Tidak ada notifikasi baru');
        });
    }
});

// Handle Login Form Submission
function handleLogin(e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    // Simple client-side validation
    if (!email || !password) {
        alert('Email dan password harus diisi');
        return;
    }

    // Simulate login (store in localStorage)
    const userData = {
        name: 'Wanda Hamidah',
        email: email,
        isAuthenticated: true,
        loginTime: new Date().toISOString()
    };

    localStorage.setItem('user', JSON.stringify(userData));

    // Show success message
    alert('Login berhasil! Selamat datang.');

    // Redirect to homepage
    window.location.href = '/';
}

// Handle Register Form Submission
function handleRegister(e) {
    e.preventDefault();

    const nama = document.getElementById('nama').value;
    const kontak = document.getElementById('kontak').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('password_confirmation').value;

    // Validation
    if (!nama || !kontak || !email || !password || !passwordConfirm) {
        alert('Semua field harus diisi');
        return;
    }

    if (password !== passwordConfirm) {
        alert('Password dan konfirmasi password tidak cocok');
        return;
    }

    if (password.length < 8) {
        alert('Password minimal 8 karakter');
        return;
    }

    // Simulate registration (store in localStorage)
    const userData = {
        name: nama,
        email: email,
        kontak: kontak,
        isAuthenticated: true,
        loginTime: new Date().toString()
    };

    localStorage.setItem('user', JSON.stringify(userData));

    // Show success message
    alert('Registrasi berhasil! Anda akan diarahkan ke halaman utama.');

    // Redirect to homepage
    window.location.href = '/';
}

// Check Authentication State and Update UI
function checkAuthState() {
    const user = JSON.parse(localStorage.getItem('user'));

    if (user && user.isAuthenticated) {
        // User is logged in - update header
        updateHeaderForAuthUser(user);

        // Update profile page if on profile page
        updateProfilePage(user);
    } else {
        // User is not logged in - show default header
        updateHeaderForGuest();
    }
}

// Update Header for Authenticated User  
function updateHeaderForAuthUser(user) {
    const navMenu = document.getElementById('navMenu');
    if (!navMenu) return;

    // Remove login button if exists
    const loginBtn = navMenu.querySelector('.btn-primary');
    if (loginBtn && loginBtn.textContent.includes('Login')) {
        loginBtn.parentElement.remove();
    }

    // Check if notification and profile buttons already exist
    const existingNotifBtn = document.getElementById('notificationBtn');
    const existingProfileBtn = document.getElementById('profileBtn');

    if (!existingNotifBtn && !existingProfileBtn) {
        // Add Riwayat menu item
        const riwayatLi = document.createElement('li');
        riwayatLi.className = 'nav-item';
        riwayatLi.innerHTML = `<a href="#riwayat" class="nav-link">Riwayat</a>`;

        // Add notification icon
        const notifLi = document.createElement('li');
        notifLi.className = 'nav-item';
        notifLi.innerHTML = `
            <button class="icon-btn" id="notificationBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                    </path>
                </svg>
            </button>
        `;

        // Add profile icon  
        const profileLi = document.createElement('li');
        profileLi.className = 'nav-item';
        profileLi.innerHTML = `
            <button class="icon-btn" id="profileBtn">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                    </path>
                </svg>
            </button>
        `;

        navMenu.appendChild(riwayatLi);
        navMenu.appendChild(notifLi);
        navMenu.appendChild(profileLi);

        // Add event listeners
        document.getElementById('notificationBtn').addEventListener('click', function () {
            alert('Tidak ada notifikasi baru');
        });

        document.getElementById('profileBtn').addEventListener('click', function () {
            window.location.href = '/profile';
        });
    }
}

// Update Header for Guest User
function updateHeaderForGuest() {
    const navMenu = document.getElementById('navMenu');
    if (!navMenu) return;

    // Remove Riwayat menu if it exists
    const riwayatLink = Array.from(navMenu.querySelectorAll('.nav-link')).find(link => link.textContent === 'Riwayat');
    if (riwayatLink) riwayatLink.parentElement.remove();

    // Remove notification and profile buttons if they exist
    const notifBtn = document.getElementById('notificationBtn');
    const profileBtn = document.getElementById('profileBtn');

    if (notifBtn) notifBtn.parentElement.remove();
    if (profileBtn) profileBtn.parentElement.remove();

    // Make sure login button exists
    const existingLoginBtn = navMenu.querySelector('.btn-primary');
    if (!existingLoginBtn || !existingLoginBtn.textContent.includes('Login')) {
        const loginLi = document.createElement('li');
        loginLi.className = 'nav-item';
        loginLi.innerHTML = `
            <a href="/login" class="btn btn-primary">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                    </path>
                </svg>
                Login
            </a>
        `;
        navMenu.appendChild(loginLi);
    }
}

// Update Profile Page with User Data
function updateProfilePage(user) {
    const userName = document.getElementById('userName');
    const userEmail = document.getElementById('userEmail');

    // If on profile page but not authenticated, redirect to login
    if ((userName || userEmail) && !user) {
        alert('Anda harus login terlebih dahulu');
        window.location.href = '/login';
        return;
    }

    if (userName && user.name) {
        userName.textContent = user.name;
    }

    if (userEmail && user.email) {
        userEmail.textContent = user.email;
    }
}

// Logout Function (can be called from anywhere)
function logout() {
    localStorage.removeItem('user');
    alert('Anda telah logout');
    window.location.href = '/';
}

// Toggle Password Visibility
function togglePassword() {
    const passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
    } else {
        passwordInput.type = 'password';
    }
}

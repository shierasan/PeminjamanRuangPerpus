// ============================================
// Auth - Login Form Handler (Admin Only)
// ============================================
document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('loginForm');

    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
        console.log('Login form handler attached');
    }
});

// Handle Login Form Submission
async function handleLogin(e) {
    e.preventDefault();
    console.log('=== Login Attempt ===');

    const email = document.getElementById('email')?.value;
    const password = document.getElementById('password')?.value;
    const csrfToken = document.querySelector('input[name="_token"]')?.value ||
        document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    if (!email || !password) {
        alert('Email dan password harus diisi');
        return;
    }

    if (!csrfToken) {
        console.error('CSRF token not found');
        alert('Error: CSRF token tidak ditemukan');
        return;
    }

    console.log('Sending login request...');

    try {
        const response = await fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();
        console.log('Response:', data);

        if (data.success) {
            console.log('Login successful! Redirecting to:', data.redirect);
            window.location.href = data.redirect;
        } else {
            console.error('Login failed:', data.message);
            alert(data.message || 'Login gagal!');
        }
    } catch (error) {
        console.error('Login error:', error);
        alert('Terjadi kesalahan saat login. Silakan coba lagi.');
    }
}

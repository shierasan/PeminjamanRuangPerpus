// Admin Dashboard JavaScript
document.addEventListener('DOMContentLoaded', function () {
    // Sidebar Toggle
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('overlay');

    if (sidebarToggle && sidebar) {
        sidebarToggle.addEventListener('click', function () {
            // On mobile, show/hide sidebar
            if (window.innerWidth <= 1024) {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            } else {
                // On desktop, collapse/expand sidebar
                sidebar.classList.toggle('collapsed');
            }
        });
    }

    // Close sidebar when clicking overlay
    if (overlay) {
        overlay.addEventListener('click', function () {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        });
    }

    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.3s';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Table row hover effect
    const tableRows = document.querySelectorAll('.data-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function () {
            this.style.backgroundColor = '#F9FAFB';
        });
        row.addEventListener('mouseleave', function () {
            this.style.backgroundColor = '';
        });
    });

    // Confirm delete actions
    const deleteForms = document.querySelectorAll('form[onsubmit*="confirm"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            const confirmMessage = this.getAttribute('onsubmit').match(/'([^']+)'/)[1];
            if (!confirm(confirmMessage)) {
                e.preventDefault();
                return false;
            }
        });
    });

    // File input preview
    const fileInputs = document.querySelectorAll('input[type="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    // Create preview if it doesn't exist
                    let preview = input.parentElement.querySelector('.image-preview');
                    if (!preview) {
                        preview = document.createElement('div');
                        preview.className = 'image-preview';
                        preview.style.marginTop = '1rem';
                        input.parentElement.insertBefore(preview, input.nextSibling);
                    }
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" style="max-width: 200px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">`;
                };
                if (file.type.startsWith('image/')) {
                    reader.readAsDataURL(file);
                }
            }
        });
    });

    // Form validation - add visual feedback
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        inputs.forEach(input => {
            input.addEventListener('blur', function () {
                if (this.value.trim() === '') {
                    this.style.borderColor = '#EF4444';
                } else {
                    this.style.borderColor = '#10B981';
                }
            });

            input.addEventListener('input', function () {
                if (this.value.trim() !== '') {
                    this.style.borderColor = '';
                }
            });
        });
    });

    // Responsive - close sidebar on window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 1024) {
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
        }
    });

    // Auto-expand textarea based on content
    const textareas = document.querySelectorAll('textarea.form-control');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function () {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Badge color animation on load
    const badges = document.querySelectorAll('.badge');
    badges.forEach((badge, index) => {
        setTimeout(() => {
            badge.style.opacity = '0';
            badge.style.transform = 'scale(0.9)';
            badge.style.transition = 'all 0.3s ease-in-out';
            setTimeout(() => {
                badge.style.opacity = '1';
                badge.style.transform = 'scale(1)';
            }, 50);
        }, index * 100);
    });

    // Smooth scroll to top
    const scrollToTop = document.createElement('button');
    scrollToTop.innerHTML = `
        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    `;
    scrollToTop.style.cssText = `
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 48px;
        height: 48px;
        background-color: var(--color-primary);
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: none;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
        z-index: 1000;
    `;
    scrollToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    document.body.appendChild(scrollToTop);

    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            scrollToTop.style.display = 'flex';
        } else {
            scrollToTop.style.display = 'none';
        }
    });

    // Print stats animation
    const statValues = document.querySelectorAll('.stat-value');
    statValues.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        if (!isNaN(finalValue)) {
            let currentValue = 0;
            const increment = Math.ceil(finalValue / 50);
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= finalValue) {
                    stat.textContent = finalValue;
                    clearInterval(timer);
                } else {
                    stat.textContent = currentValue;
                }
            }, 20);
        }
    });
});

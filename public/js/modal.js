/**
 * SIPRUS Custom Modal
 * Modern replacement for browser's native confirm() dialog
 */

// Create modal HTML structure
function createModalHTML() {
    if (document.getElementById('siprus-modal')) return;

    const modalHTML = `
        <div id="siprus-modal" class="modal-overlay">
            <div class="modal-box">
                <div id="modal-icon" class="modal-icon warning">
                    <svg id="modal-icon-svg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <h3 id="modal-title" class="modal-title">Konfirmasi</h3>
                <p id="modal-message" class="modal-message">Apakah Anda yakin?</p>
                <div class="modal-buttons">
                    <button id="modal-cancel" class="modal-btn cancel">Batal</button>
                    <button id="modal-confirm" class="modal-btn danger">Ya, Hapus</button>
                </div>
            </div>
        </div>
    `;

    document.body.insertAdjacentHTML('beforeend', modalHTML);
}

// Icon paths for different types
const iconPaths = {
    warning: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>',
    danger: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>',
    success: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>',
    info: '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
};

/**
 * Show custom confirmation modal
 * @param {Object} options - Modal options
 * @param {string} options.title - Modal title
 * @param {string} options.message - Modal message
 * @param {string} options.type - Modal type: 'warning', 'danger', 'success', 'info'
 * @param {string} options.confirmText - Confirm button text
 * @param {string} options.cancelText - Cancel button text
 * @param {string} options.confirmClass - Confirm button class: 'confirm', 'danger', 'success'
 * @returns {Promise<boolean>} - Returns true if confirmed, false if cancelled
 */
function showModal(options = {}) {
    return new Promise((resolve) => {
        createModalHTML();

        const modal = document.getElementById('siprus-modal');
        const iconEl = document.getElementById('modal-icon');
        const iconSvg = document.getElementById('modal-icon-svg');
        const titleEl = document.getElementById('modal-title');
        const messageEl = document.getElementById('modal-message');
        const confirmBtn = document.getElementById('modal-confirm');
        const cancelBtn = document.getElementById('modal-cancel');

        // Set options with defaults
        const type = options.type || 'warning';
        titleEl.textContent = options.title || 'Konfirmasi';
        messageEl.textContent = options.message || 'Apakah Anda yakin ingin melanjutkan?';
        confirmBtn.textContent = options.confirmText || 'Ya, Lanjutkan';
        cancelBtn.textContent = options.cancelText || 'Batal';

        // Set icon type
        iconEl.className = 'modal-icon ' + type;
        iconSvg.innerHTML = iconPaths[type] || iconPaths.warning;

        // Set confirm button class
        confirmBtn.className = 'modal-btn ' + (options.confirmClass || 'danger');

        // Show modal
        setTimeout(() => modal.classList.add('active'), 10);

        // Handle confirm
        const handleConfirm = () => {
            modal.classList.remove('active');
            cleanup();
            resolve(true);
        };

        // Handle cancel
        const handleCancel = () => {
            modal.classList.remove('active');
            cleanup();
            resolve(false);
        };

        // Handle overlay click
        const handleOverlayClick = (e) => {
            if (e.target === modal) {
                handleCancel();
            }
        };

        // Handle escape key
        const handleEscape = (e) => {
            if (e.key === 'Escape') {
                handleCancel();
            }
        };

        // Cleanup function
        const cleanup = () => {
            confirmBtn.removeEventListener('click', handleConfirm);
            cancelBtn.removeEventListener('click', handleCancel);
            modal.removeEventListener('click', handleOverlayClick);
            document.removeEventListener('keydown', handleEscape);
        };

        // Add event listeners
        confirmBtn.addEventListener('click', handleConfirm);
        cancelBtn.addEventListener('click', handleCancel);
        modal.addEventListener('click', handleOverlayClick);
        document.addEventListener('keydown', handleEscape);
    });
}

/**
 * Confirm delete action
 * @param {string} itemName - Name of item being deleted
 * @returns {Promise<boolean>}
 */
function confirmDelete(itemName = 'item ini') {
    return showModal({
        title: 'Hapus ' + itemName + '?',
        message: 'Data yang dihapus tidak dapat dikembalikan. Apakah Anda yakin ingin menghapus ' + itemName + '?',
        type: 'danger',
        confirmText: 'Ya, Hapus',
        cancelText: 'Batal',
        confirmClass: 'danger'
    });
}

/**
 * Confirm cancel/reject action
 * @param {string} actionName - Name of action
 * @returns {Promise<boolean>}
 */
function confirmAction(actionName = 'tindakan ini') {
    return showModal({
        title: 'Konfirmasi',
        message: 'Apakah Anda yakin ingin ' + actionName + '?',
        type: 'warning',
        confirmText: 'Ya, Lanjutkan',
        cancelText: 'Batal',
        confirmClass: 'confirm'
    });
}

/**
 * Confirm approve action  
 * @param {string} itemName - Name of item being approved
 * @returns {Promise<boolean>}
 */
function confirmApprove(itemName = 'permintaan ini') {
    return showModal({
        title: 'Setujui ' + itemName + '?',
        message: 'Apakah Anda yakin ingin menyetujui ' + itemName + '?',
        type: 'success',
        confirmText: 'Ya, Setujui',
        cancelText: 'Batal',
        confirmClass: 'success'
    });
}

// Initialize modal on DOM ready
document.addEventListener('DOMContentLoaded', createModalHTML);

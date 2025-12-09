<!-- FOOTER -->
<footer class="footer" style="background: linear-gradient(135deg, #1a3a3a 0%, #0d4d4d 100%);">
    <div class="container">
        <div class="footer-content">
            <div class="footer-about">
                <h3 style="color: #B8985F;">TENTANG</h3>
                <p>
                    SIPRUS (Sistem Informasi Peminjaman Ruang Perpustakaan Universitas Andalas) dibuat untuk mempermudah
                    sivitas akademika dalam melihat
                    ketersediaan, memesan ruangan, dan memantau status peminjaman secara online dan real-time tanpa
                    proses manual.
                </p>
            </div>
            <div class="footer-links">
                <h3 style="color: #B8985F;">LINK CEPAT</h3>
                <ul>
                    <li><a href="{{ route('home') }}" style="color: rgba(255,255,255,0.8);">Beranda</a></li>
                    <li><a href="{{ route('user.rooms') }}" style="color: rgba(255,255,255,0.8);">Daftar Ruangan</a>
                    </li>
                    <li><a href="{{ route('user.announcements.index') }}"
                            style="color: rgba(255,255,255,0.8);">Pengumuman</a></li>
                    <li><a href="{{ route('user.terms.index') }}" style="color: rgba(255,255,255,0.8);">Syarat &
                            Ketentuan</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom" style="border-top: 1px solid rgba(184, 152, 95, 0.3);">
            <p style="color: rgba(255,255,255,0.7);">&copy; 2025 SIPRUS by Tim SIPRUS<br>Universitas Andalas</p>
        </div>
    </div>
</footer>
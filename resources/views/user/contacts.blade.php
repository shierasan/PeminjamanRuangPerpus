@extends('layouts.user')

@section('title', 'Informasi - Kontak dan Layanan')

@section('content')
    <div class="container" style="max-width: 1100px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 2rem;">Informasi</h1>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">
                {{-- Contact Card --}}
                <div
                    style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border: 1px solid rgba(184, 152, 95, 0.3); border-radius: 12px; padding: 2rem;">
                    {{-- Card Header --}}
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <h2 style="font-size: 1.25rem; font-weight: 700; color: #B8985F; margin-bottom: 0.5rem;">Kontak dan
                            Layanan</h2>
                        <p style="color: #666; font-size: 0.875rem;">Layanan bantuan dan kontak resmi untuk pertanyaan
                            seputar peminjaman ruangan.</p>
                    </div>

                    {{-- Phone --}}
                    <div style="margin-bottom: 1.5rem;">
                        <div style="color: #B8985F; font-weight: 600; font-size: 0.875rem; margin-bottom: 0.5rem;">Phone
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="width: 40px; height: 40px; background: rgba(184, 152, 95, 0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="20" height="20" fill="#B8985F" viewBox="0 0 24 24">
                                    <path
                                        d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                                </svg>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1a1a1a;">{{ $contact->phone_title }}</div>
                                <div style="color: #666; font-size: 0.875rem;">{{ $contact->phone_number }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div style="margin-bottom: 1.5rem;">
                        <div style="color: #B8985F; font-weight: 600; font-size: 0.875rem; margin-bottom: 0.5rem;">Email
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <div
                                style="width: 40px; height: 40px; background: rgba(184, 152, 95, 0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                <svg width="20" height="20" fill="#B8985F" viewBox="0 0 24 24">
                                    <path
                                        d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                </svg>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1a1a1a;">{{ $contact->email_title }}</div>
                                <div style="color: #666; font-size: 0.875rem;">{{ $contact->email_address }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Location --}}
                    <div>
                        <div style="color: #B8985F; font-weight: 600; font-size: 0.875rem; margin-bottom: 0.5rem;">Location
                        </div>
                        <div style="display: flex; align-items: flex-start; gap: 1rem;">
                            <div
                                style="width: 40px; height: 40px; background: rgba(184, 152, 95, 0.15); border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                <svg width="20" height="20" fill="#B8985F" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                                </svg>
                            </div>
                            <div>
                                <div style="font-weight: 600; color: #1a1a1a;">{{ $contact->location_title }}</div>
                                <div style="color: #666; font-size: 0.875rem;">{{ $contact->location_address }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FAQ Card --}}
                <div style="background: white; border: 1px solid #E5E7EB; border-radius: 12px; padding: 2rem;">
                    <div style="text-align: center; margin-bottom: 2rem;">
                        <h2 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">FAQ</h2>
                        <p style="color: #666; font-size: 0.875rem;">Frequently Asked Questions</p>
                    </div>

                    {{-- FAQ Items --}}
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        <div class="faq-item" style="border: 1px solid #E5E7EB; border-radius: 8px; overflow: hidden;">
                            <button onclick="toggleFaq(this)"
                                style="width: 100%; padding: 1rem; background: white; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; text-align: left;">
                                <span style="font-weight: 500; color: #374151;">Bagaimana cara meminjam ruangan?</span>
                                <svg class="faq-arrow" width="20" height="20" fill="none" stroke="#9CA3AF"
                                    viewBox="0 0 24 24" style="transition: transform 0.3s;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-content"
                                style="display: none; padding: 0 1rem 1rem; color: #666; font-size: 0.875rem;">
                                Anda dapat meminjam ruangan dengan mengakses menu Peminjaman, memilih ruangan yang tersedia,
                                lalu mengisi form peminjaman dengan lengkap.
                            </div>
                        </div>

                        <div class="faq-item" style="border: 1px solid #E5E7EB; border-radius: 8px; overflow: hidden;">
                            <button onclick="toggleFaq(this)"
                                style="width: 100%; padding: 1rem; background: white; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; text-align: left;">
                                <span style="font-weight: 500; color: #374151;">Berapa lama proses persetujuan?</span>
                                <svg class="faq-arrow" width="20" height="20" fill="none" stroke="#9CA3AF"
                                    viewBox="0 0 24 24" style="transition: transform 0.3s;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-content"
                                style="display: none; padding: 0 1rem 1rem; color: #666; font-size: 0.875rem;">
                                Proses persetujuan biasanya memakan waktu 1-2 hari kerja. Anda akan menerima notifikasi
                                setelah admin meninjau permohonan Anda.
                            </div>
                        </div>

                        <div class="faq-item" style="border: 1px solid #E5E7EB; border-radius: 8px; overflow: hidden;">
                            <button onclick="toggleFaq(this)"
                                style="width: 100%; padding: 1rem; background: white; border: none; cursor: pointer; display: flex; justify-content: space-between; align-items: center; text-align: left;">
                                <span style="font-weight: 500; color: #374151;">Bagaimana cara membatalkan
                                    peminjaman?</span>
                                <svg class="faq-arrow" width="20" height="20" fill="none" stroke="#9CA3AF"
                                    viewBox="0 0 24 24" style="transition: transform 0.3s;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="faq-content"
                                style="display: none; padding: 0 1rem 1rem; color: #666; font-size: 0.875rem;">
                                Untuk membatalkan peminjaman, akses menu Riwayat, pilih peminjaman yang ingin dibatalkan,
                                lalu ajukan pembatalan dengan menyertakan alasan.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFaq(button) {
            const content = button.nextElementSibling;
            const arrow = button.querySelector('.faq-arrow');

            if (content.style.display === 'none') {
                content.style.display = 'block';
                arrow.style.transform = 'rotate(180deg)';
            } else {
                content.style.display = 'none';
                arrow.style.transform = 'rotate(0deg)';
            }
        }
    </script>
@endsection
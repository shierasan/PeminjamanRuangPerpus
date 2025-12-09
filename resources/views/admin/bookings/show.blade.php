@extends('layouts.app')

@section('title', 'Riwayat (Lihat Detail)')

@section('content')
    <div style="padding: 2rem 4rem; min-height: 100vh; background: #f5f5f5;">
        <div style="max-width: 700px; margin: 0 auto;">
            <!-- White Card Container -->
            <div style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

                <!-- Header with Room Badge -->
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem;">
                    <h1 style="font-size: 1.5rem; font-weight: 700; color: #000; margin: 0;">
                        Form Pengajuan Peminjaman
                    </h1>

                    <div style="text-align: right;">
                        <div
                            style="padding: 0.5rem 1.25rem; background: #FFF9E6; border: 1px solid #D4AF37; border-radius: 20px; margin-bottom: 0.5rem;">
                            <span
                                style="font-weight: 600; color: #000; font-size: 0.875rem;">{{ $booking->room->name }}</span>
                        </div>
                        @if($booking->status === 'cancelled')
                            <div style="display: flex; align-items: center; gap: 0.375rem; justify-content: flex-end;">
                                <span
                                    style="width: 8px; height: 8px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                <span style="color: #f59e0b; font-size: 0.8125rem; font-weight: 500;">Dibatalkan</span>
                            </div>
                        @elseif($booking->status === 'rejected')
                            <div style="display: flex; align-items: center; gap: 0.375rem; justify-content: flex-end;">
                                <span
                                    style="width: 8px; height: 8px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                <span style="color: #ef4444; font-size: 0.8125rem; font-weight: 500;">Ditolak</span>
                            </div>
                        @elseif($booking->status === 'approved')
                            <div style="display: flex; align-items: center; gap: 0.375rem; justify-content: flex-end;">
                                <span
                                    style="width: 8px; height: 8px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                                <span style="color: #10b981; font-size: 0.8125rem; font-weight: 500;">Disetujui</span>
                            </div>
                        @elseif($booking->status === 'pending')
                            <div style="display: flex; align-items: center; gap: 0.375rem; justify-content: flex-end;">
                                <span
                                    style="width: 8px; height: 8px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                <span style="color: #f59e0b; font-size: 0.8125rem; font-weight: 500;">Menunggu</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tanggal yang dipilih -->
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Tanggal yang dipilih
                    </h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.875rem;">
                        <input type="text" value="{{ $booking->booking_date->format('d F Y') }}" readonly
                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #374151;">

                        <input type="text"
                            value="{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}"
                            readonly
                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #374151;">
                    </div>
                </div>

                <!-- Informasi Kegiatan -->
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Informasi Kegiatan
                    </h3>

                    <div style="margin-bottom: 0.875rem;">
                        <label
                            style="display: block; font-size: 0.8125rem; color: #000; margin-bottom: 0.375rem; font-weight: 500;">Nama
                            Kegiatan</label>
                        <input type="text" value="{{ $booking->event_name ?? '' }}" readonly
                            placeholder="Masukkan nama kegiatan"
                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #6b7280;">
                    </div>

                    <div style="margin-bottom: 0.875rem;">
                        <label
                            style="display: block; font-size: 0.8125rem; color: #000; margin-bottom: 0.375rem; font-weight: 500;">Penyelenggara</label>
                        <input type="text" value="{{ $booking->organizer ?? '' }}" readonly
                            placeholder="Masukkan nama penyelenggara"
                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #6b7280;">
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 0.8125rem; color: #000; margin-bottom: 0.375rem; font-weight: 500;">Jumlah
                            Peserta</label>
                        <input type="text" value="{{ $booking->participants_count ?? '' }}" readonly
                            placeholder="Masukkan jumlah peserta"
                            style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #6b7280;">
                    </div>
                </div>

                <!-- Dokumentasi Pendukung -->
                <div style="margin-bottom: 2.5rem; position: relative;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Dokumentasi Pendukung
                    </h3>

                    @if($booking->letter_file || $booking->rundown_file)
                        <div style="display: flex; flex-direction: column; gap: 0.625rem;">
                            @if($booking->letter_file)
                                <a href="{{ asset('storage/' . $booking->letter_file) }}" target="_blank"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; color: #3b82f6; text-decoration: none; font-size: 0.875rem;">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                        <polyline points="14 2 14 8 20 8" stroke="white" stroke-width="2" fill="none" />
                                    </svg>
                                    Surat pengajuan
                                </a>
                            @endif

                            @if($booking->rundown_file)
                                <a href="{{ asset('storage/' . $booking->rundown_file) }}" target="_blank"
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; color: #3b82f6; text-decoration: none; font-size: 0.875rem;">
                                    <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                        <polyline points="14 2 14 8 20 8" stroke="white" stroke-width="2" fill="none" />
                                    </svg>
                                    Rundown Acara
                                </a>
                            @endif
                        </div>

                        <!-- Calendar Icon in bottom right of document section -->
                        <div style="position: absolute; bottom: 0; right: 0;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </div>
                    @else
                        <div
                            style="padding: 1.5rem; background: #f9fafb; border: 1px dashed #d1d5db; border-radius: 8px; text-align: center;">
                            <p style="color: #9ca3af; margin: 0; font-size: 0.875rem;">Tidak ada dokumen yang diupload
                            </p>
                        </div>
                    @endif
                </div>

                {{-- Cancelled status with reason --}}
                @if($booking->status === 'cancelled')
                    <div
                        style="margin-top: 1.5rem; padding: 1rem; background: #FEF3C7; border-left: 4px solid #F59E0B; border-radius: 8px;">
                        <div style="color: #92400E; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">
                            ⚠️ Peminjaman Dibatalkan
                        </div>
                        @if($booking->cancellation_reason)
                            <div style="color: #78350F; margin-bottom: 0.5rem;">
                                <strong>Alasan Pembatalan:</strong>
                            </div>
                            <div style="color: #92400E;">{{ $booking->cancellation_reason }}</div>
                        @endif
                    </div>
                @endif

                <!-- Action Buttons -->
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem;">
                    <a href="{{ route('admin.bookings.index') }}"
                        style="color: #B8985F; text-decoration: underline; font-weight: 500; font-size: 0.9375rem;">
                        Kembali
                    </a>

                    @if($booking->status === 'pending')
                        <div style="display: flex; gap: 0.875rem;">
                            <!-- Tolak Button -->
                            <button onclick="showRejectModal()"
                                style="padding: 0.625rem 2rem; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9375rem;">
                                Tolak
                            </button>

                            <!-- Setujui Button -->
                            <button onclick="showApproveModal()"
                                style="padding: 0.625rem 2rem; background: #10b981; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 0.9375rem;">
                                Setujui
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    @if($booking->status === 'pending')
        <div id="approveModal"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
            <div
                style="background: white; border-radius: 16px; padding: 2rem; max-width: 500px; width: 90%; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
                <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: #1a1a1a;">
                    Konfirmasi Persetujuan
                </h3>
                <form action="{{ route('admin.bookings.approve', $booking) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 1.5rem;">
                        <label style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem;">
                            Catatan (Opsional)
                        </label>
                        <textarea name="note" rows="4" placeholder="Tambahkan catatan untuk peminjam..."
                            style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                        <button type="button" onclick="hideApproveModal()"
                            style="padding: 0.75rem 1.5rem; background: #FFF9E6; color: #B8985F; border: 1px solid #B8985F; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Batal
                        </button>
                        <button type="submit"
                            style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Reject Modal -->
        <div id="rejectModal"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
            <div
                style="background: white; border-radius: 16px; padding: 2rem; max-width: 500px; width: 90%; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
                <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: #1a1a1a;">
                    Alasan Penolakan
                </h3>
                <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                    @csrf
                    <div style="margin-bottom: 1.5rem;">
                        <textarea name="note" required rows="4" placeholder="Masukkan alasan penolakan..."
                            style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; resize: vertical;"></textarea>
                    </div>
                    <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                        <button type="button" onclick="hideRejectModal()"
                            style="padding: 0.75rem 1.5rem; background: #FFF9E6; color: #B8985F; border: 1px solid #B8985F; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Batal
                        </button>
                        <button type="submit"
                            style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function showApproveModal() {
                document.getElementById('approveModal').style.display = 'flex';
            }

            function hideApproveModal() {
                document.getElementById('approveModal').style.display = 'none';
            }

            function showRejectModal() {
                document.getElementById('rejectModal').style.display = 'flex';
            }

            function hideRejectModal() {
                document.getElementById('rejectModal').style.display = 'none';
            }

            // Close modal when clicking outside
            document.getElementById('approveModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    hideApproveModal();
                }
            });

            document.getElementById('rejectModal').addEventListener('click', function (e) {
                if (e.target === this) {
                    hideRejectModal();
                }
            });
        </script>
    @endif
@endsection
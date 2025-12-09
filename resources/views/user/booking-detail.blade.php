@extends('layouts.user')

@section('title', 'Detail Peminjaman')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 1200px;">

        <!-- Header with Status Badge and Back Button -->
        <div
            style="background: white; border-radius: 16px; padding: 2rem; margin-bottom: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin: 0;">
                    Detail Peminjaman
                </h1>
                <div>
                    @if($booking->status === 'pending')
                        <span
                            style="padding: 0.5rem 1.5rem; background: #f59e0b; color: white; border-radius: 8px; font-weight: 600;">
                            ⏳ Menunggu Persetujuan
                        </span>
                    @elseif($booking->status === 'approved')
                        <span
                            style="padding: 0.5rem 1.5rem; background: #10b981; color: white; border-radius: 8px; font-weight: 600;">
                            ✓ Disetujui
                        </span>
                    @elseif($booking->status === 'rejected')
                        <span
                            style="padding: 0.5rem 1.5rem; background: #ef4444; color: white; border-radius: 8px; font-weight: 600;">
                            ✗ Ditolak
                        </span>
                    @endif
                </div>
            </div>
            <a href="{{ route('user.history') }}"
                style="display: inline-block; padding: 0.75rem 2rem; background: #f3f4f6; color: #374151; border-radius: 8px; text-decoration: none; font-weight: 600;">
                ← Kembali ke Riwayat
            </a>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem;">

            <!-- Left Column: Booking Information -->
            <div style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h2 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1.5rem;">
                    Informasi Peminjaman
                </h2>

                <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                    <div>
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Nama Kegiatan</div>
                        <div style="font-weight: 600; color: #1a1a1a;">{{ $booking->event_name ?? '-' }}</div>
                    </div>

                    <div>
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Penyelenggara</div>
                        <div style="font-weight: 600; color: #1a1a1a;">{{ $booking->organizer ?? '-' }}</div>
                    </div>

                    <div>
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Jumlah Peserta</div>
                        <div style="font-weight: 600; color: #1a1a1a;">{{ $booking->participants_count ?? '-' }} orang</div>
                    </div>

                    <div>
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Tanggal Peminjaman</div>
                        <div style="font-weight: 600; color: #1a1a1a;">{{ $booking->booking_date->format('d M Y') }}</div>
                    </div>

                    <div>
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.25rem;">Waktu</div>
                        <div style="font-weight: 600; color: #1a1a1a;">
                            {{ date('H:i', strtotime($booking->start_time)) }} -
                            {{ date('H:i', strtotime($booking->end_time)) }}
                        </div>
                    </div>

                </div>

                @if($booking->letter_file || $booking->rundown_file)
                    <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.75rem; font-weight: 600;">📎 Dokumentasi
                            Pendukung</div>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            @if($booking->letter_file)
                                <a href="{{ asset('storage/' . $booking->letter_file) }}" target="_blank" download
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; color: #3b82f6; text-decoration: none; font-weight: 500; font-size: 0.875rem;">
                                    <svg width="16" height="16" fill="#3b82f6" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                    Surat Pengajuan
                                </a>
                            @endif

                            @if($booking->rundown_file)
                                <a href="{{ asset('storage/' . $booking->rundown_file) }}" target="_blank" download
                                    style="display: inline-flex; align-items: center; gap: 0.5rem; color: #3b82f6; text-decoration: none; font-weight: 500; font-size: 0.875rem;">
                                    <svg width="16" height="16" fill="#3b82f6" viewBox="0 0 24 24">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                    </svg>
                                    Rundown Acara
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

                @if($booking->status === 'rejected' && $booking->admin_note)
                    <div
                        style="margin-top: 1.5rem; padding: 1rem; background: #fee2e2; border-left: 4px solid #ef4444; border-radius: 8px;">
                        <div style="color: #dc2626; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">
                            Alasan Penolakan:
                        </div>
                        <div style="color: #991b1b;">{{ $booking->admin_note }}</div>
                    </div>
                @endif

                @if($booking->status === 'approved' && $booking->admin_note)
                    <div
                        style="margin-top: 1.5rem; padding: 1rem; background: #d1fae5; border-left: 4px solid #10b981; border-radius: 8px;">
                        <div style="color: #059669; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">
                            Catatan Admin:
                        </div>
                        <div style="color: #047857;">{{ $booking->admin_note }}</div>
                    </div>
                @endif

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

                {{-- Action Buttons Section --}}
                @if($booking->status === 'pending')
                    {{-- Delete button for pending bookings --}}
                    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <form action="{{ route('user.bookings.delete', $booking->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini? Tindakan ini tidak dapat dibatalkan.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                style="padding: 0.75rem 1.5rem; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.5rem;">
                                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Hapus Pengajuan
                            </button>
                        </form>
                    </div>
                @elseif($booking->status === 'approved' && !$booking->cancellation_requested && !$booking->key_returned)
                    {{-- Cancel request button for approved bookings --}}
                    <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e5e7eb;">
                        <div style="margin-bottom: 1rem;">
                            <h4 style="font-weight: 600; color: #1a1a1a; margin-bottom: 0.5rem;">Ajukan Pembatalan</h4>
                            <p style="color: #666; font-size: 0.875rem;">Jika Anda tidak dapat menggunakan ruangan, silakan
                                ajukan pembatalan di bawah ini.</p>
                        </div>
                        <form action="{{ route('user.bookings.cancel', $booking->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin mengajukan pembatalan?');">
                            @csrf
                            <div style="margin-bottom: 1rem;">
                                <label
                                    style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.875rem;">Alasan
                                    Pembatalan <span style="color: #ef4444;">*</span></label>
                                <textarea name="cancellation_reason" rows="3" required
                                    style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.875rem; resize: vertical;"
                                    placeholder="Jelaskan alasan pembatalan..."></textarea>
                            </div>
                            <button type="submit"
                                style="padding: 0.75rem 1.5rem; background: #f59e0b; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                                Ajukan Pembatalan
                            </button>
                        </form>
                    </div>
                @elseif($booking->cancellation_requested && $booking->cancellation_status === 'pending')
                    {{-- Cancellation pending notice --}}
                    <div
                        style="margin-top: 2rem; padding: 1rem; background: #FEF3C7; border-left: 4px solid #F59E0B; border-radius: 8px;">
                        <div style="color: #92400E; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem;">
                            ⏳ Pembatalan Sedang Diproses
                        </div>
                        <div style="color: #78350F;">Pengajuan pembatalan Anda sedang menunggu persetujuan admin.</div>
                        @if($booking->cancellation_reason)
                            <div style="margin-top: 0.5rem; color: #92400E; font-size: 0.875rem;">
                                <strong>Alasan:</strong> {{ $booking->cancellation_reason }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Right Column: Room Information - Image at Top -->
            <div>
                <!-- Room Corner Badge -->
                <div
                    style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">
                    <h2 style="font-size: 1.25rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1rem;">
                        Gibei Corner
                    </h2>

                    <!-- Room Image/Icon -->
                    <div
                        style="background: linear-gradient(135deg, #B8985F, #9d7d4b); height: 200px; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.5rem;">
                        <svg width="80" height="80" fill="white" viewBox="0 0 24 24">
                            <path d="M3 21V3h18v18H3zm16-2V5H5v14h14zM8 11h8v2H8v-2zm0-4h8v2H8V7z"></path>
                        </svg>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.5rem;">Deskripsi</div>
                        <div style="color: #374151; line-height: 1.6;">{{ $booking->room->description }}</div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <svg width="20" height="20" fill="#B8985F" viewBox="0 0 24 24">
                            <path
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z">
                            </path>
                        </svg>
                        <span style="font-weight: 600; color: #1a1a1a;">{{ $booking->room->capacity }} orang</span>
                    </div>

                    @if($booking->room->facilities)
                        <div style="margin-bottom: 1.5rem;">
                            <div style="color: #666; font-size: 0.875rem; margin-bottom: 0.75rem; font-weight: 600;">Fasilitas
                            </div>
                            <div style="display: flex; flex-wrap: wrap; gap: 0.5rem;">
                                @php
                                    $facilities = is_array($booking->room->facilities)
                                        ? $booking->room->facilities
                                        : explode(',', $booking->room->facilities);
                                @endphp
                                @foreach($facilities as $facility)
                                    <span
                                        style="padding: 0.25rem 0.75rem; background: #f3f4f6; color: #374151; border-radius: 6px; font-size: 0.875rem;">
                                        {{ is_string($facility) ? trim($facility) : $facility }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($booking->room->contact_number)
                        <div style="padding: 1rem; background: #FFF9E6; border-radius: 8px;">
                            <div style="color: #B8985F; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.25rem;">
                                Contact Person
                            </div>
                            <div style="color: #1a1a1a; font-weight: 600;">
                                {{ $booking->room->contact_person ?? 'Petugas Perpustakaan' }}
                            </div>
                            <div style="color: #666;">{{ $booking->room->contact_number }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
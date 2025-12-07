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
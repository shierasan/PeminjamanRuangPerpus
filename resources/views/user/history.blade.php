@extends('layouts.user')

@section('title', 'Riwayat')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 1100px;">

        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem;">
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem 0; color: #1a1a1a;">
                        Riwayat
                    </h1>
                    <p style="color: #666; margin: 0;">
                        Melihat daftar peminjaman yang pernah Anda ajukan beserta status dan detailnya.
                    </p>
                </div>

                <select
                    style="padding: 0.75rem 1.5rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer; font-size: 0.875rem;">
                    <option>Urutkan</option>
                    <option>Terbaru</option>
                    <option>Terlama</option>
                </select>
            </div>

            <!-- Table -->
            @if($bookings->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Nama Kegiatan</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Penyelenggara</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Tanggal</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Waktu</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Nama Ruangan</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Status</th>
                                <th
                                    style="padding: 1rem; text-align: left; font-weight: 600; color: #374151; font-size: 0.875rem;">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                                <tr style="border-bottom: 1px solid #f3f4f6;">
                                    <td style="padding: 1rem; font-size: 0.875rem;">{{ $booking->event_name ?? '-' }}</td>
                                    <td style="padding: 1rem; font-size: 0.875rem;">{{ $booking->organizer ?? '-' }}</td>
                                    <td style="padding: 1rem; font-size: 0.875rem;">{{ $booking->booking_date->format('d M Y') }}
                                    </td>
                                    <td style="padding: 1rem; font-size: 0.875rem;">
                                        {{ date('H:i', strtotime($booking->start_time)) }} -
                                        {{ date('H:i', strtotime($booking->end_time)) }}</td>
                                    <td style="padding: 1rem; font-size: 0.875rem;">{{ $booking->room->name }}</td>
                                    <td style="padding: 1rem;">
                                        @if($booking->status === 'pending')
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span
                                                    style="width: 10px; height: 10px; background: #f59e0b; border-radius: 50%; display: inline-block;"></span>
                                                <span style="color: #f59e0b; font-size: 0.875rem; font-weight: 500;">Menunggu
                                                    Persetujuan</span>
                                            </div>
                                        @elseif($booking->status === 'approved')
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span
                                                    style="width: 10px; height: 10px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                                                <span style="color: #10b981; font-size: 0.875rem; font-weight: 500;">Disetujui</span>
                                            </div>
                                        @elseif($booking->status === 'rejected')
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span
                                                    style="width: 10px; height: 10px; background: #ef4444; border-radius: 50%; display: inline-block;"></span>
                                                <span style="color: #ef4444; font-size: 0.875rem; font-weight: 500;">Ditolak</span>
                                            </div>
                                        @elseif($booking->cancellation_requested === true && $booking->cancellation_status === 'pending')
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span
                                                    style="width: 10px; height: 10px; background: #a855f7; border-radius: 50%; display: inline-block;"></span>
                                                <span style="color: #a855f7; font-size: 0.875rem; font-weight: 500;">Menunggu
                                                    Pembatalan</span>
                                            </div>
                                        @elseif($booking->cancellation_status === 'approved')
                                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                                <span
                                                    style="width: 10px; height: 10px; background: #9ca3af; border-radius: 50%; display: inline-block;"></span>
                                                <span style="color: #9ca3af; font-size: 0.875rem; font-weight: 500;">Dibatalkan</span>
                                            </div>
                                        @endif
                                    </td>
                                    <td style="padding: 1rem;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                                            @if($booking->status === 'pending')
                                                <a href="{{ route('user.bookings.detail', $booking->id) }}"
                                                   style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #f59e0b, #d97706); color: white; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                                                    Menunggu Persetujuan
                                                </a>
                                            @elseif($booking->status === 'approved')
                                                <a href="{{ route('user.bookings.detail', $booking->id) }}"
                                                   style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #10b981, #059669); color: white; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                                                    Lihat Detail
                                                </a>
                                            @elseif($booking->status === 'rejected')
                                                <a href="{{ route('user.bookings.detail', $booking->id) }}"
                                                   style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #ef4444, #dc2626); color: white; border-radius: 6px; font-size: 0.75rem; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center;">
                                                    Lihat Alasan
                                                </a>
                                            @endif
                                            
                                            @if($booking->status === 'pending')
                                            <button
                                                style="padding: 0.5rem; background: #fee2e2; border: none; border-radius: 6px; cursor: pointer;">
                                                <svg width="16" height="16" fill="#dc2626" viewBox="0 0 24 24">
                                                    <path
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div style="text-align: center; padding: 4rem 2rem;">
                    <svg width="80" height="80" fill="none" stroke="#ccc" style="margin: 0 auto 1rem;" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <p style="color: #999; font-size: 1.125rem;">Belum ada riwayat peminjaman</p>
                </div>
            @endif
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Daftar Pengajuan Peminjaman - Admin')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 1.5rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">
                    Daftar Pengajuan Peminjaman
                </h1>
                <p style="color: #666; font-size: 0.95rem;">
                    Setuju/tolak peminjaman ruangan yang diajukan
                </p>
            </div>

            {{-- Search and Filter --}}
            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: center;">
                <div style="flex: 1; position: relative;">
                    <svg style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: #999;"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" id="searchInput" placeholder="Cari berdasarkan nama"
                        style="width: 100%; padding: 0.75rem 1rem 0.75rem 3rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                </div>
                <select id="sortSelect"
                    style="padding: 0.75rem 2.5rem 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; background: white url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%227%22 viewBox=%220 0 12 7%22%3E%3Cpath fill=%22%23666%22 d=%22M6 7L0 0h12z%22/%3E%3C/svg%3E') no-repeat right 1rem center; appearance: none;">
                    <option value="desc">Terbaru</option>
                    <option value="asc">Terlama</option>
                </select>
                <button onclick="applyFilters()"
                    style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                    Terapkan
                </button>
            </div>

            {{-- Table --}}
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                    <thead>
                        <tr style="background: #f8f9fa;">
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Nama Ruangan</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Nama Kegiatan</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Nama Peminjam</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Penyelenggara</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Tanggal</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Waktu</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($bookings as $booking)
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 1rem;">{{ $booking->room->name }}</td>
                                <td style="padding: 1rem;">{{ $booking->event_name ?? '-' }}</td>
                                <td style="padding: 1rem;">{{ $booking->user->name }}</td>
                                <td style="padding: 1rem;">{{ $booking->organizer ?? '-' }}</td>
                                <td style="padding: 1rem;">{{ $booking->booking_date->format('d M Y') }}</td>
                                <td style="padding: 1rem;">{{ date('H:i', strtotime($booking->start_time)) }} -
                                    {{ date('H:i', strtotime($booking->end_time)) }}
                                </td>
                                <td style="padding: 1rem;">
                                    @if($booking->status === 'cancelled')
                                        {{-- Cancelled status - Yellow/Orange --}}
                                        <div style="display: flex; flex-direction: column; gap: 0.25rem; align-items: flex-start;">
                                            <span
                                                style="padding: 0.4rem 1rem; background: #FEF3C7; color: #92400E; border-radius: 6px; font-size: 0.875rem; display: inline-block; font-weight: 500;">
                                                Dibatalkan
                                            </span>
                                            @if($booking->cancellation_reason)
                                                <small
                                                    style="color: #666; font-size: 0.7rem; max-width: 150px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"
                                                    title="{{ $booking->cancellation_reason }}">
                                                    {{ Str::limit($booking->cancellation_reason, 30) }}
                                                </small>
                                            @endif
                                        </div>
                                    @elseif($booking->status === 'pending')
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                            style="padding: 0.4rem 1rem; background: #f59e0b; color: white; border-radius: 6px; font-size: 0.875rem; text-decoration: none; display: inline-block; font-weight: 500;">
                                            Tinjau
                                        </a>
                                    @elseif($booking->status === 'approved')
                                        @if($booking->isWaitingKeyReturn())
                                            {{-- Waiting for key return --}}
                                            <div style="display: flex; flex-direction: column; gap: 0.5rem; align-items: flex-start;">
                                                <span
                                                    style="padding: 0.3rem 0.75rem; background: #FEF3C7; color: #92400E; border-radius: 4px; font-size: 0.75rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    Menunggu Kunci
                                                </span>
                                                <form action="{{ route('admin.bookings.key-returned', $booking->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    <button type="submit"
                                                        style="padding: 0.4rem 0.75rem; background: #10b981; color: white; border: none; border-radius: 6px; font-size: 0.75rem; cursor: pointer; font-weight: 500;">
                                                        ✓ Kunci Dikembalikan
                                                    </button>
                                                </form>
                                            </div>
                                        @elseif($booking->key_returned)
                                            {{-- Completed --}}
                                            <span
                                                style="padding: 0.4rem 1rem; background: #d1fae5; color: #059669; border-radius: 6px; font-size: 0.875rem; display: inline-flex; align-items: center; gap: 0.25rem;">
                                                <svg width="14" height="14" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                                Selesai
                                            </span>
                                        @else
                                            {{-- Approved and active or upcoming --}}
                                            <span
                                                style="padding: 0.4rem 1rem; background: #10b981; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Setuju</span>
                                        @endif
                                    @elseif($booking->status === 'rejected')
                                        <span
                                            style="padding: 0.4rem 1rem; background: #ef4444; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Tolak</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="padding: 3rem; text-align: center; color: #999;">
                                    <svg style="width: 64px; height: 64px; margin: 0 auto 1rem; color: #ddd;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div style="font-size: 1.1rem;">Tidak ada pengajuan peminjaman</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($bookings->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function applyFilters() {
            const search = document.getElementById('searchInput').value;
            const sort = document.getElementById('sortSelect').value;
            window.location.href = `{{ route('admin.bookings.index') }}?search=${search}&sort=${sort}`;
        }

        // Enter key to search
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });
    </script>
@endsection
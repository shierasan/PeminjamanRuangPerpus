@extends('layouts.app')

@section('title', 'Riwayat Peminjaman - Admin')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">
                    Riwayat Pengajuan Peminjaman
                </h1>
                <p style="color: #666; font-size: 0.95rem;">
                    Lihat riwayat peminjaman ruangan yang diajukan
                </p>
            </div>

            {{-- Search and Filter --}}
            <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: center;">
                <div style="flex: 1; position: relative;">
                    <label
                        style="display: block; font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Pencarian</label>
                    <div style="position: relative;">
                        <svg style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: #999;"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" id="searchInput" placeholder="Cari berdasarkan nama"
                            value="{{ request('search') }}"
                            style="width: 100%; padding: 0.75rem 1rem 0.75rem 3rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                    </div>
                </div>
                <div>
                    <label style="display: block; font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Urutkan</label>
                    <select id="sortSelect"
                        style="padding: 0.75rem 2.5rem 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem; background: white url('data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%2212%22 height=%227%22 viewBox=%220 0 12 7%22%3E%3Cpath fill=%22%23666%22 d=%22M6 7L0 0h12z%22/%3E%3C/svg%3E') no-repeat right 1rem center; appearance: none; min-width: 150px;">
                        <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </div>
                <button onclick="applyFilters()"
                    style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; margin-top: 1.5rem;">
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
                                Nama Kegiatan</th>
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
                                Nama Ruangan</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Status</th>
                            <th
                                style="padding: 1rem; text-align: left; font-weight: 600; color: #333; border-bottom: 2px solid #e0e0e0;">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        @forelse($bookings as $booking)
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 1rem;">{{ $booking->event_name ?? 'Tidak ada nama kegiatan' }}</td>
                                <td style="padding: 1rem;">{{ $booking->organizer ?? $booking->user->name }}</td>
                                <td style="padding: 1rem;">{{ $booking->booking_date->format('d M Y') }}</td>
                                <td style="padding: 1rem;">{{ date('H:i', strtotime($booking->start_time)) }} -
                                    {{ date('H:i', strtotime($booking->end_time)) }}
                                </td>
                                <td style="padding: 1rem;">{{ $booking->room->name }}</td>
                                <td style="padding: 1rem;">
                                    @if($booking->status === 'pending')
                                        <span
                                            style="padding: 0.4rem 0.8rem; background: #f59e0b; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Menunggu
                                            persetujuan</span>
                                    @elseif($booking->status === 'approved')
                                        <span
                                            style="padding: 0.4rem 0.8rem; background: #10b981; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Disetujui</span>
                                    @elseif($booking->status === 'rejected')
                                        <span
                                            style="padding: 0.4rem 0.8rem; background: #ef4444; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Ditolak</span>
                                    @elseif($booking->cancellation_requested && $booking->cancellation_status === 'pending')
                                        <span
                                            style="padding: 0.4rem 0.8rem; background: #ec4899; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Menunggu
                                            pembatalan</span>
                                    @elseif($booking->status === 'cancelled')
                                        <span
                                            style="padding: 0.4rem 0.8rem; background: #6b7280; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Dibatalkan</span>
                                    @endif
                                </td>
                                <td style="padding: 1rem;">
                                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                            style="padding: 0.4rem 1rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 6px; font-size: 0.875rem; text-decoration: none; display: inline-block; font-weight: 500;">
                                            Lihat Detail
                                        </a>
                                        <form action="{{ route('admin.history.destroy', $booking->id) }}" method="POST"
                                            id="delete-history-{{ $booking->id }}" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="handleDeleteHistory({{ $booking->id }})"
                                                style="padding: 0.4rem 0.6rem; background: #ef4444; color: white; border: none; border-radius: 6px; cursor: pointer;">
                                                <svg width="16" height="16" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 3rem; text-align: center; color: #999;">
                                    <svg style="width: 64px; height: 64px; margin: 0 auto 1rem; color: #ddd;" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    <div style="font-size: 1.1rem;">Tidak ada riwayat peminjaman</div>
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
            window.location.href = `{{ route('admin.history.index') }}?search=${search}&sort=${sort}`;
        }

        // Enter key to search
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });

        // Handle delete with custom modal
        async function handleDeleteHistory(id) {
            const confirmed = await confirmDelete('riwayat ini');
            if (confirmed) {
                document.getElementById('delete-history-' + id).submit();
            }
        }
    </script>
@endsection
@extends('layouts.app')

@section('title', 'Daftar Pengajuan Pembatalan - Admin')

@section('content')
    <div class="container" style="max-width: 1200px; margin: 2rem auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">
                    Daftar Pengajuan Pembatalan
                </h1>
                <p style="color: #666; font-size: 0.95rem;">
                    Setuju/tolak pembatalan ruangan yang diajukan
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
                        @forelse($cancellations as $cancellation)
                            <tr style="border-bottom: 1px solid #f0f0f0;">
                                <td style="padding: 1rem;">{{ $cancellation->room->name }}</td>
                                <td style="padding: 1rem;">{{ $cancellation->event_name ?? '-' }}</td>
                                <td style="padding: 1rem;">{{ $cancellation->organizer ?? $cancellation->user->name }}</td>
                                <td style="padding: 1rem;">{{ $cancellation->booking_date->format('d M Y') }}</td>
                                <td style="padding: 1rem;">{{ date('H:i', strtotime($cancellation->start_time)) }} -
                                    {{ date('H:i', strtotime($cancellation->end_time)) }}</td>
                                <td style="padding: 1rem;">
                                    @if($cancellation->cancellation_status === 'pending' || $cancellation->cancellation_status === null)
                                        <div style="display: flex; gap: 0.5rem;">
                                            <form action="{{ route('admin.cancellations.approve', $cancellation->id) }}"
                                                method="POST" style="margin: 0;">
                                                @csrf
                                                <button type="submit"
                                                    style="padding: 0.4rem 1rem; background: #10b981; color: white; border: none; border-radius: 6px; font-size: 0.875rem; cursor: pointer; font-weight: 500;">
                                                    Setuju
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.cancellations.reject', $cancellation->id) }}"
                                                method="POST" style="margin: 0;">
                                                @csrf
                                                <button type="submit"
                                                    style="padding: 0.4rem 1rem; background: #ef4444; color: white; border: none; border-radius: 6px; font-size: 0.875rem; cursor: pointer; font-weight: 500;">
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @elseif($cancellation->cancellation_status === 'approved')
                                        <span
                                            style="padding: 0.4rem 1rem; background: #10b981; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Disetujui</span>
                                    @else
                                        <span
                                            style="padding: 0.4rem 1rem; background: #ef4444; color: white; border-radius: 6px; font-size: 0.875rem; display: inline-block;">Ditolak</span>
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
                                    <div style="font-size: 1.1rem;">Tidak ada pengajuan pembatalan</div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($cancellations->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $cancellations->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        function applyFilters() {
            const search = document.getElementById('searchInput').value;
            const sort = document.getElementById('sortSelect').value;
            window.location.href = `{{ route('admin.cancellations.index') }}?search=${search}&sort=${sort}`;
        }

        // Enter key to search
        document.getElementById('searchInput').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                applyFilters();
            }
        });
    </script>
@endsection
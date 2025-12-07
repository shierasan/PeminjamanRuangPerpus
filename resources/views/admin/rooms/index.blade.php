@extends('layouts.app')

@section('title', 'Daftar Ruangan - Perpustakaan Unand')

@section('content')
    <!-- ROOM LIST SECTION -->
    <section class="section" style="padding-top: 3rem; background-color: #F5F7FA;">
        <div class="container">
            <h2 style="text-align: center; margin-bottom: 1rem;">Daftar Ruangan Perpustakaan</h2>
            <p style="text-align: center; color: var(--color-text-light); margin-bottom: 3rem;">
                Pilih ruangan yang ingin digunakan dan lanjutkan ke peminjaman.
            </p>

            <!-- Search & Filter Section -->
            <div
                style="background-color: var(--color-secondary); padding: 2rem; border-radius: 1rem; margin-bottom: 3rem; box-shadow: var(--shadow-sm);">
                <div style="display: grid; grid-template-columns: 1fr auto auto; gap: 1rem; align-items: end;">
                    <div>
                        <label
                            style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--color-dark); font-size: 0.875rem;">Pencarian</label>
                        <div style="position: relative;">
                            <svg style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 20px; height: 20px; color: var(--color-text-light);"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" id="searchInput" placeholder="Cari berdasarkan nama"
                                style="width: 100%; padding: 0.875rem 1rem 0.875rem 3rem; border: 1px solid #E5E7EB; border-radius: 0.5rem; font-size: 1rem;">
                        </div>
                    </div>
                    <div>
                        <label
                            style="display: block; margin-bottom: 0.5rem; font-weight: 600; color: var(--color-dark); font-size: 0.875rem;">Lantai</label>
                        <select id="categoryFilter"
                            style="width: 200px; padding: 0.875rem 1rem; border: 1px solid #E5E7EB; border-radius: 0.5rem; font-size: 1rem; background-color: white;">
                            <option value="">Semua Lantai</option>
                            <option value="1">Lantai 1</option>
                            <option value="2">Lantai 2</option>
                            <option value="3">Lantai 3</option>
                            <option value="4">Lantai 4</option>
                            <option value="5">Lantai 5</option>
                        </select>
                    </div>
                    <button onclick="filterRooms()" class="btn btn-primary"
                        style="padding: 0.875rem 2rem; height: fit-content;">
                        Cari
                    </button>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                <!-- Room Cards Grid -->
                <div>
                    @if($rooms->count() > 0)
                        <div id="roomsGrid"
                            style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
                            @foreach($rooms as $room)
                                <div class="card room-card" data-floor="{{ $room->floor }}"
                                    style="overflow: hidden; transition: all 0.3s;">
                                    <div
                                        style="position: relative; height: 200px; overflow: hidden; border-radius: 0.75rem 0.75rem 0 0; margin: -1.5rem -1.5rem 1rem -1.5rem;">
                                        @if($room->image)
                                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div
                                                style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--color-primary), var(--color-teal)); display: flex; align-items: center; justify-content: center;">
                                                <svg width="64" height="64" fill="none" stroke="white" stroke-width="1.5"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <h3
                                        style="font-size: 1.25rem; font-weight: 700; color: var(--color-dark); margin-bottom: 0.5rem;">
                                        {{ $room->name }}</h3>
                                    <p
                                        style="color: var(--color-text); font-size: 0.875rem; margin-bottom: 1rem; line-height: 1.6;">
                                        {{ $room->description ? Str::limit($room->description, 100) : 'Ruang bersahabat besar yang cocok digunakan untuk kegiatan seperti...' }}
                                    </p>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div
                                            style="display: flex; align-items: center; gap: 0.5rem; color: var(--color-text-light); font-size: 0.875rem;">
                                            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <span>{{ $room->capacity }} orang</span>
                                        </div>
                                        <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-primary btn-sm"
                                            style="display: inline-flex; align-items: center; gap: 0.5rem;">
                                            Edit Ruang
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div style="display: flex; justify-content: center; gap: 0.5rem; margin-top: 2rem;">
                            {{ $rooms->links() }}
                        </div>
                    @else
                        <div style="text-align: center; padding: 4rem; background-color: white; border-radius: 1rem;">
                            <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="margin: 0 auto 1rem; color: var(--color-text-light);">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <p style="color: var(--color-text-light); font-size: 1.125rem;">Belum ada ruangan yang ditambahkan
                            </p>
                            <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary" style="margin-top: 1rem;">Tambah
                                Ruangan Pertama</a>
                        </div>
                    @endif

                    <!-- Tambah Ruangan Button (Fixed positioning for design) -->
                    <a href="{{ route('admin.rooms.create') }}"
                        style="position: fixed; bottom: 2rem; left: 2rem; background-color: var(--color-primary); color: white; padding: 1rem 1.5rem; border-radius: 3rem; display: inline-flex; align-items: center; gap: 0.75rem; font-weight: 600; box-shadow: var(--shadow-xl); z-index: 100; transition: all 0.3s;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 25px 50px -12px rgba(0,0,0,0.25)'"
                        onmouseout="this.style.transform=''; this.style.boxShadow='0 20px 25px -5px rgba(0,0,0,0.1)'">
                        <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Ruangan
                    </a>
                </div>

                <!-- Sidebar -->
                <div>
                    <!-- Calendar Widget -->
                    <div class="card" style="margin-bottom: 1.5rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; text-align: center; margin-bottom: 1.5rem;">
                            Kalender</h3>

                        <div id="calendar" style="padding: 1rem;">
                            <!-- Calendar will be generated by JavaScript -->
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                                <button onclick="previousMonth()"
                                    style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <div id="currentMonth" style="font-weight: 600; font-size: 1rem;"></div>
                                <button onclick="nextMonth()"
                                    style="background: none; border: none; cursor: pointer; padding: 0.5rem;">
                                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                            </div>

                            <div id="calendarGrid"
                                style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.25rem; text-align: center;">
                                <!-- Days will be inserted here -->
                            </div>
                        </div>

                        <!-- Legend -->
                        <div style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid #E5E7EB;">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem;">
                                    <div
                                        style="width: 16px; height: 16px; background-color: var(--color-success); border-radius: 4px;">
                                    </div>
                                    <span>Tersedia penuh</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem;">
                                    <div style="width: 16px; height: 16px; background-color: #EF4444; border-radius: 4px;">
                                    </div>
                                    <span>Terbooking penuh</span>
                                </div>
                                <div style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem;">
                                    <div
                                        style="width: 16px; height: 16px; background-color: var(--color-warning); border-radius: 4px;">
                                    </div>
                                    <span>Tersedia sebagian</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Popular Rooms -->
                    <div class="card">
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem;">Paling Sering Dipinjam</h3>
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @php
                                $popularRooms = $rooms->take(3); // Mock data, ideally sorted by booking count
                            @endphp
                            @foreach($popularRooms as $index => $room)
                                <div
                                    style="display: flex; gap: 1rem; align-items: center; padding: 0.75rem; border-radius: 0.5rem; background-color: #F9FAFB;">
                                    <div
                                        style="width: 48px; height: 48px; border-radius: 0.5rem; background: linear-gradient(135deg, var(--color-primary), var(--color-teal)); display: flex; align-items: center; justify-content: center; color: white; font-weight: 700; font-size: 1.25rem; flex-shrink: 0;">
                                        {{ $index + 1 }}
                                    </div>
                                    <div style="flex: 1; min-width: 0;">
                                        <div style="font-weight: 600; color: var(--color-dark); margin-bottom: 0.25rem;">
                                            {{ $room->name }}</div>
                                        <div
                                            style="font-size: 0.75rem; color: var(--color-text-light); display: flex; align-items: center; gap: 0.25rem;">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            {{ rand(45, 90) }} kali dipinjam
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('scripts')
    <script>
        // Simple calendar implementation
        let currentDate = new Date();

        function renderCalendar() {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            document.getElementById('currentMonth').textContent = monthNames[month] + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let calendarHTML = '';

            // Day headers
            const dayHeaders = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            dayHeaders.forEach(day => {
                calendarHTML += `<div style="font-weight: 600; font-size: 0.75rem; color: var(--color-text-light); padding: 0.5rem 0;">${day}</div>`;
            });

            // Empty cells before first day
            const startDay = firstDay === 0 ? 6 : firstDay - 1;
            for (let i = 0; i < startDay; i++) {
                calendarHTML += '<div style="padding: 0.5rem;"></div>';
            }

            // Days
            const today = new Date();
            for (let day = 1; day <= daysInMonth; day++) {
                const isToday = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();
                const randomStatus = Math.random();
                let bgColor = 'transparent';
                let textColor = 'var(--color-text)';

                if (day >= today.getDate() && month === today.getMonth()) {
                    if (randomStatus > 0.7) {
                        bgColor = 'var(--color-success)';
                        textColor = 'white';
                    } else if (randomStatus > 0.4) {
                        bgColor = 'var(--color-warning)';
                        textColor = 'white';
                    } else {
                        bgColor = '#EF4444';
                        textColor = 'white';
                    }
                }

                calendarHTML += `<div style="padding: 0.5rem; font-size: 0.875rem; ${isToday ? 'font-weight: 700; border: 2px solid var(--color-primary);' : ''} background-color: ${bgColor}; color: ${textColor}; border-radius: 0.25rem;">${day}</div>`;
            }

            document.getElementById('calendarGrid').innerHTML = calendarHTML;
        }

        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        }

        // Initialize calendar
        renderCalendar();

        // Search and filter functionality
        function filterRooms() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const floorFilter = document.getElementById('categoryFilter').value;
            const roomCards = document.querySelectorAll('.room-card');

            roomCards.forEach(card => {
                const roomName = card.querySelector('h3').textContent.toLowerCase();
                const roomFloor = card.getAttribute('data-floor');

                const matchesSearch = roomName.includes(searchTerm);
                const matchesFloor = !floorFilter || roomFloor === floorFilter;

                card.style.display = matchesSearch && matchesFloor ? 'block' : 'none';
            });
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('input', filterRooms);
        document.getElementById('categoryFilter').addEventListener('change', filterRooms);
    </script>
@endsection


@section('title', 'Manajemen Ruangan')
@section('page-title', 'Manajemen Ruangan')

@section('content')
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">Daftar Ruangan</h3>
            <div class="table-actions">
                <div class="search-box">
                    <svg class="search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" class="search-input" placeholder="Cari ruangan..." id="searchInput">
                </div>
                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary btn-sm">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Ruangan
                </a>
            </div>
        </div>

        @if($rooms->count() > 0)
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama Ruangan</th>
                        <th>Lantai</th>
                        <th>Kapasitas</th>
                        <th>Fasilitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td><strong>{{ $room->name }}</strong></td>
                            <td>{{ $room->floor }}</td>
                            <td>{{ $room->capacity }} orang</td>
                            <td>
                                @if($room->facilities)
                                    {{ implode(', ', array_slice($room->facilities, 0, 3)) }}
                                    @if(count($room->facilities) > 3)
                                        <span style="color: var(--color-text-light)">+{{ count($room->facilities) - 3 }} lainnya</span>
                                    @endif
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                @if($room->is_available)
                                    <span class="badge active">Tersedia</span>
                                @else
                                    <span class="badge inactive">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.rooms.edit', $room) }}" class="btn btn-sm btn-primary"
                                        style="background-color: var(--color-teal);">
                                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini?');"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination">
                {{ $rooms->links() }}
            </div>
        @else
            <div style="padding: 3rem; text-align: center; color: #9CA3AF;">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 1rem;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <p>Belum ada ruangan yang ditambahkan</p>
                <a href="{{ route('admin.rooms.create') }}" class="btn btn-primary" style="margin-top: 1rem;">
                    Tambah Ruangan Pertama
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Simple client-side search
        document.getElementById('searchInput').addEventListener('input', function (e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.data-table tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>
@endpush
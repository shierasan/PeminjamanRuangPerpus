@extends('layouts.user')

@section('title', 'Peminjaman Ruangan')

@section('content')
    <div class="container" style="padding: 3rem 0;">

        <!-- Page Header -->
        <div style="text-align: center; margin-bottom: 3rem;">
            <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a;">
                Daftar Ruangan
            </h1>
            <p style="color: #666;">
                Pilih ruangan yang ingin digunakan dan lanjutkan ke peminjaman
            </p>
        </div>

        <!-- Search & Filter Section -->
        <div style="background: #FFF9E6; padding: 2rem; border-radius: 12px; margin-bottom: 3rem;">
            <form action="{{ route('user.rooms') }}" method="GET">
                <div style="display: grid; grid-template-columns: 1fr auto auto; gap: 1rem; align-items: end;">
                    <!-- Search Input -->
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #B8985F;">
                            Pencarian
                        </label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama"
                            style="width: 100%; padding: 0.75rem 1rem 0.75rem 2.5rem; border: 1px solid #E6D5A8; border-radius: 8px; background: white;">
                        <svg style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); pointer-events: none;"
                            width="20" height="20" fill="none" stroke="#999" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>

                    <!-- Floor Filter -->
                    <div>
                        <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #B8985F;">
                            Lantai
                        </label>
                        <select name="floor"
                            style="padding: 0.75rem 2.5rem 0.75rem 1rem; border: 1px solid #E6D5A8; border-radius: 8px; background: white; min-width: 180px; cursor: pointer;">
                            <option value="">Semua Lantai</option>
                            <option value="1" {{ request('floor') == '1' ? 'selected' : '' }}>Lantai 1</option>
                            <option value="2" {{ request('floor') == '2' ? 'selected' : '' }}>Lantai 2</option>
                            <option value="3" {{ request('floor') == '3' ? 'selected' : '' }}>Lantai 3</option>
                            <option value="4" {{ request('floor') == '4' ? 'selected' : '' }}>Lantai 4</option>
                            <option value="5" {{ request('floor') == '5' ? 'selected' : '' }}>Lantai 5</option>
                        </select>
                    </div>

                    <!-- Search Button -->
                    <button type="submit"
                        style="padding: 0.75rem 2.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                        Cari
                    </button>
                </div>
            </form>
        </div>

        <!-- Main Grid: Rooms + Sidebar -->
        <div style="display: grid; grid-template-columns: 1fr 350px; gap: 2rem;">

            <!-- Rooms Grid -->
            <div>
                @if($rooms->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; margin-bottom: 2rem;">
                        @foreach($rooms as $room)
                            <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: all 0.3s;"
                                onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)'"
                                onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">

                                <!-- Room Image -->
                                @if($room->image)
                                    <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                                        style="width: 100%; height: 200px; object-fit: cover;">
                                @else
                                    <div
                                        style="width: 100%; height: 200px; background: linear-gradient(135deg, #B8985F, #9d7d4b); display: flex; align-items: center; justify-content: center;">
                                        <svg width="60" height="60" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Room Info -->
                                <div style="padding: 1.5rem;">
                                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a;">
                                        {{ $room->name }}
                                    </h3>
                                    <p style="color: #666; font-size: 0.875rem; line-height: 1.6; margin-bottom: 1rem;">
                                        {{ Str::limit($room->description ?? 'Ruang berkapasitas besar yang cocok digunakan untuk kegiatan seperti...', 80) }}
                                    </p>

                                    <!-- Capacity & Detail -->
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <div style="display: flex; align-items: center; gap: 0.5rem; color: #B8985F;">
                                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            <span style="font-weight: 600; font-size: 0.875rem;">{{ $room->capacity }} orang</span>
                                        </div>

                                        <a href="{{ route('user.rooms.detail', $room->id) }}"
                                            style="color: #B8985F; font-weight: 600; text-decoration: none; font-size: 0.875rem;">
                                            Lihat Detail »
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div style="display: flex; justify-content: center; gap: 0.5rem;">
                        {{-- Previous --}}
                        @if ($rooms->onFirstPage())
                            <span
                                style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 6px; color: #ccc;">&laquo;</span>
                        @else
                            <a href="{{ $rooms->previousPageUrl() }}"
                                style="padding: 0.5rem 0.75rem; border: 1px solid #B8985F; border-radius: 6px; color: #B8985F; text-decoration: none;">&laquo;</a>
                        @endif

                        {{-- Page Numbers --}}
                        @for ($i = 1; $i <= $rooms->lastPage(); $i++)
                            @if ($i == $rooms->currentPage())
                                <span
                                    style="padding: 0.5rem 0.75rem; background: #B8985F; color: white; border-radius: 6px; font-weight: 600;">{{ $i }}</span>
                            @else
                                <a href="{{ $rooms->url($i) }}"
                                    style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 6px; color: #666; text-decoration: none;">{{ $i }}</a>
                            @endif
                        @endfor

                        {{-- Next --}}
                        @if ($rooms->hasMorePages())
                            <a href="{{ $rooms->nextPageUrl() }}"
                                style="padding: 0.5rem 0.75rem; border: 1px solid #B8985F; border-radius: 6px; color: #B8985F; text-decoration: none;">&raquo;</a>
                        @else
                            <span
                                style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 6px; color: #ccc;">&raquo;</span>
                        @endif
                    </div>
                @else
                    <div style="text-align: center; padding: 4rem 2rem; background: #f9f9f9; border-radius: 12px;">
                        <svg width="80" height="80" fill="none" stroke="#ccc" style="margin: 0 auto 1rem;" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <p style="color: #999; font-size: 1.125rem;">Tidak ada ruangan ditemukan</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Calendar Widget -->
                <div style="background: #FFF9E6; padding: 2rem; border-radius: 12px; margin-bottom: 2rem;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; text-align: center; margin-bottom: 1.5rem;">
                        Kalender
                    </h3>

                    <div id="calendar" style="padding: 0;">
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <div id="calendarGrid" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.25rem;">
                        </div>
                    </div>

                    <!-- Legend -->
                    <div style="margin-top: 1.5rem; font-size: 0.75rem;">
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <div style="width: 16px; height: 16px; background: #10b981; border-radius: 4px;"></div>
                            <span>tersedia penuh</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem;">
                            <div style="width: 16px; height: 16px; background: #EF4444; border-radius: 4px;"></div>
                            <span>terbooking penuh</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 0.5rem;">
                            <div style="width: 16px; height: 16px; background: #F59E0B; border-radius: 4px;"></div>
                            <span>tersedia sebagian</span>
                        </div>
                    </div>
                </div>

                <!-- Popular Rooms Widget -->
                <div style="background: #FFF9E6; padding: 2rem; border-radius: 12px;">
                    <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem;">
                        Paling Sering Dipinjam
                    </h3>

                    @if($popularRooms->count() > 0)
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            @foreach($popularRooms as $popular)
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <div
                                        style="width: 60px; height: 60px; background: white; border-radius: 8px; overflow: hidden; flex-shrink: 0;">
                                        @if($popular->image)
                                            <img src="{{ asset('storage/' . $popular->image) }}" alt="{{ $popular->name }}"
                                                style="width: 100%; height: 100%; object-fit: cover;">
                                        @else
                                            <div
                                                style="width: 100%; height: 100%; background: #B8985F; display: flex; align-items: center; justify-content: center;">
                                                <svg width="24" height="24" fill="none" stroke="white" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div style="flex: 1;">
                                        <h4 style="font-weight: 700; margin-bottom: 0.25rem; font-size: 0.95rem;">
                                            {{ $popular->name }}
                                        </h4>
                                        <p
                                            style="color: #B8985F; font-size: 0.75rem; display: flex; align-items: center; gap: 0.25rem;">
                                            <span style="width: 6px; height: 6px; background: #B8985F; border-radius: 50%;"></span>
                                            {{ $popular->bookings_count }} kali dipinjam
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #999; text-align: center;">Belum ada data</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Calendar implementation with real booking data
        let currentDate = new Date();
        const allBookings = @json($allBookings);
        const allClosures = @json($allClosures);
        const totalRooms = {{ $totalRooms }};
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        function isSunday(year, month, day) {
            const date = new Date(year, month, day);
            return date.getDay() === 0;
        }

        function isPastDate(year, month, day) {
            const date = new Date(year, month, day);
            return date < today;
        }

        // H-2 rule: booking must be at least 2 days in advance
        function isWithinMinBookingDays(year, month, day) {
            const date = new Date(year, month, day);
            const minBookingDate = new Date(today);
            minBookingDate.setDate(minBookingDate.getDate() + 2);
            return date < minBookingDate;
        }

        function getBookingInfo(dateStr) {
            return allBookings[dateStr] || { count: 0, approved_count: 0, rooms_booked: 0 };
        }

        function getClosureInfo(dateStr) {
            return allClosures[dateStr] || { all_rooms_closed: false, has_closures: false, count: 0 };
        }

        function renderCalendar() {
            const monthNames = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            document.getElementById('currentMonth').textContent = monthNames[month] + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let calendarHTML = '';

            // Day headers
            const dayHeaders = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
            dayHeaders.forEach((day, index) => {
                const color = index === 6 ? '#EF4444' : '#666';
                calendarHTML += `<div style="font-weight: 600; font-size: 0.75rem; color: ${color}; padding: 0.5rem 0; text-align: center;">${day}</div>`;
            });

            // Empty cells before first day
            const startDay = firstDay === 0 ? 6 : firstDay - 1;
            for (let i = 0; i < startDay; i++) {
                calendarHTML += '<div style="padding: 0.5rem;"></div>';
            }

            // Days
            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const isCurrentDay = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();
                const bookingInfo = getBookingInfo(dateStr);
                const closureInfo = getClosureInfo(dateStr);

                let bgColor = '#10b981'; // Default: Green (available)
                let textColor = 'white';

                // Past dates - grey
                if (isPastDate(year, month, day)) {
                    bgColor = '#e5e7eb';
                    textColor = '#9ca3af';
                }
                // H-2 rule - light grey
                else if (isWithinMinBookingDays(year, month, day)) {
                    bgColor = '#f3f4f6';
                    textColor = '#9ca3af';
                }
                // Sunday - red (closed)
                else if (isSunday(year, month, day)) {
                    bgColor = '#EF4444';
                    textColor = 'white';
                }
                // All rooms closed (whole day) - dark red/maroon
                else if (closureInfo.all_rooms_closed) {
                    bgColor = '#991b1b';
                    textColor = 'white';
                }
                // Has some closures (partial) - yellow
                else if (closureInfo.has_closures) {
                    bgColor = '#F59E0B';
                    textColor = 'white';
                }
                // All rooms booked - red (if rooms_booked >= totalRooms)
                else if (bookingInfo.rooms_booked >= totalRooms && totalRooms > 0) {
                    bgColor = '#EF4444';
                    textColor = 'white';
                }
                // Some rooms have bookings - yellow
                else if (bookingInfo.rooms_booked > 0) {
                    bgColor = '#F59E0B';
                    textColor = 'white';
                }
                // Available - green (default)

                calendarHTML += `<div style="padding: 0.5rem; font-size: 0.875rem; text-align: center; ${isCurrentDay ? 'font-weight: 700; border: 2px solid #B8985F;' : ''} background-color: ${bgColor}; color: ${textColor}; border-radius: 0.25rem;">${day}</div>`;
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
    </script>
@endsection
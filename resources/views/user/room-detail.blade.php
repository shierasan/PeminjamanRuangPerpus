@extends('layouts.user')

@section('title', 'Detail Ruangan')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 1200px;">

        <!-- Room Detail Card -->
        <div
            style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                <!-- Left: Room Info -->
                <div>
                    <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">
                        {{ $room->name }}
                    </h1>

                    <p style="color: #666; line-height: 1.8; margin-bottom: 1.5rem;">
                        {{ $room->description ?? 'Ruang kreasi berkonsep Fresti hasil dana sama Unand dan Pengadilan diruangan untuk membantu diskusi, kerja sama dan kreativitas mahasiswa dalam suasana yang nyaman.' }}
                    </p>

                    <!-- Capacity -->
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 2rem;">
                        <div
                            style="background: #FFF9E6; padding: 0.5rem 1rem; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem;">
                            <svg width="20" height="20" fill="none" stroke="#B8985F" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span style="color: #B8985F; font-weight: 600;">{{ $room->capacity }} orang</span>
                        </div>
                    </div>

                    <!-- Facilities -->
                    <h3 style="font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">Fasilitas</h3>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 2rem;">
                        @php
                            $facilities = is_array($room->facilities) ? $room->facilities : json_decode($room->facilities, true) ?? [];
                        @endphp
                        @foreach($facilities as $facility)
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div style="width: 40px; height: 40px; background: #E8F5E9; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    @if(strtolower($facility) == 'wi-fi' || strtolower($facility) == 'wifi')
                                        {{-- WiFi Icon --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path>
                                        </svg>
                                    @elseif(strtolower($facility) == 'ac')
                                        {{-- AC/Snowflake Icon --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m0-18l4 4m-4-4L8 7m4 14l4-4m-4 4l-4-4m-5-5h18M3 12l4-4M3 12l4 4m14-4l-4-4m4 4l-4 4"></path>
                                        </svg>
                                    @elseif(strtolower($facility) == 'proyektor' || strtolower($facility) == 'projector')
                                        {{-- Projector Icon --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="2" y="6" width="20" height="12" rx="2"></rect>
                                            <circle cx="16" cy="12" r="3"></circle>
                                            <line x1="6" y1="10" x2="10" y2="10"></line>
                                            <line x1="6" y1="14" x2="10" y2="14"></line>
                                        </svg>
                                    @elseif(strtolower($facility) == 'printer')
                                        {{-- Printer Icon --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                                        </svg>
                                    @elseif(strtolower($facility) == 'komputer' || strtolower($facility) == 'computer')
                                        {{-- Computer/Desktop Icon --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="2" y="3" width="20" height="14" rx="2"></rect>
                                            <line x1="8" y1="21" x2="16" y2="21"></line>
                                            <line x1="12" y1="17" x2="12" y2="21"></line>
                                        </svg>
                                    @elseif(strtolower($facility) == 'sound system' || strtolower($facility) == 'speaker')
                                        {{-- Speaker/Sound System Icon --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <rect x="4" y="2" width="16" height="20" rx="2"></rect>
                                            <circle cx="12" cy="14" r="4"></circle>
                                            <circle cx="12" cy="6" r="2"></circle>
                                        </svg>
                                    @else
                                        {{-- Default checkmark for unknown facilities --}}
                                        <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @endif
                                </div>
                                <span style="font-weight: 500;">{{ $facility }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Contact Person -->
                    <h3 style="font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">Contact Person</h3>
                    <div
                        style="display: flex; align-items: center; gap: 1rem; background: #FFF9E6; padding: 1rem; border-radius: 8px;">
                        <svg width="24" height="24" fill="none" stroke="#B8985F" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                        <div>
                            <div style="font-weight: 600;">{{ $room->contact_name ?? 'Petugas Perpustakaan' }}</div>
                            <div style="color: #B8985F; font-size: 0.875rem;">
                                {{ $room->contact_phone ?? '+62 812-3456-7890' }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Room Photos Gallery -->
                <div>
                    @php
                        // Get all images - check images array first, then fall back to single image
                        $allImages = $room->images ?? [];
                        if (empty($allImages) && $room->image) {
                            $allImages = [$room->image];
                        }
                    @endphp

                    @if(count($allImages) > 0)
                        <!-- Main Photo Display -->
                        <div id="mainPhotoContainer" style="position: relative; margin-bottom: 1rem;">
                            <img id="mainPhoto" src="{{ asset('storage/' . $allImages[0]) }}" alt="{{ $room->name }}"
                                style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px;">
                            @if(count($allImages) > 1)
                                <div
                                    style="position: absolute; bottom: 1rem; right: 1rem; background: rgba(0,0,0,0.6); color: white; padding: 0.5rem 1rem; border-radius: 8px; font-size: 0.875rem;">
                                    <span id="photoCounter">1</span> / {{ count($allImages) }}
                                </div>
                            @endif
                        </div>

                        <!-- Photo Thumbnails -->
                        @if(count($allImages) > 1)
                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                @foreach($allImages as $index => $image)
                                    <div onclick="showPhoto({{ $index }})" id="thumb{{ $index }}"
                                        style="width: 80px; height: 80px; border-radius: 8px; overflow: hidden; cursor: pointer; border: 3px solid {{ $index === 0 ? '#B8985F' : 'transparent' }}; transition: all 0.2s;">
                                        <img src="{{ asset('storage/' . $image) }}"
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <!-- No Photo Placeholder -->
                        <div
                            style="width: 100%; height: 400px; background: linear-gradient(135deg, #B8985F, #9d7d4b); border-radius: 12px; display: flex; flex-direction: column; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <svg width="80" height="80" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span style="color: white; margin-top: 1rem; font-weight: 500;">Belum ada foto</span>
                        </div>
                    @endif

                    <script>
                        const roomImages = @json($allImages);
                        let currentPhotoIndex = 0;

                        function showPhoto(index) {
                            currentPhotoIndex = index;
                            document.getElementById('mainPhoto').src = "{{ asset('storage') }}/" + roomImages[index];
                            document.getElementById('photoCounter').textContent = (index + 1);

                            // Update thumbnail borders
                            roomImages.forEach((_, i) => {
                                document.getElementById('thumb' + i).style.border =
                                    i === index ? '3px solid #B8985F' : '3px solid transparent';
                            });
                        }
                    </script>
                </div>
            </div>
        </div>

        <!-- Booking Calendar -->
        <div
            style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Kalender Booking</h2>
                <div style="display: flex; gap: 1.5rem; font-size: 0.875rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #10b981; border-radius: 4px;"></div>
                        <span>Tersedia</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #F59E0B; border-radius: 4px;"></div>
                        <span>Sebagian Terisi</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #EF4444; border-radius: 4px;"></div>
                        <span>Libur/Penuh</span>
                    </div>
                </div>
            </div>

            <div id="bookingCalendar">
                <!-- Calendar with prev/next -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <button onclick="previousMonth()"
                        style="background: none; border: none; cursor: pointer; padding: 0.5rem; font-size: 1.25rem;">&lt;</button>
                    <h3 id="calendarMonth" style="font-weight: 600; font-size: 1.125rem; margin: 0;"></h3>
                    <button onclick="nextMonth()"
                        style="background: none; border: none; cursor: pointer; padding: 0.5rem; font-size: 1.25rem;">&gt;</button>
                </div>

                <div id="calendarTable"></div>
            </div>
        </div>

        <!-- Selected Date & Button -->
        <div
            style="background: white; border-radius: 16px; padding: 2rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center;">
            <div>
                <h3 style="font-weight: 700; margin-bottom: 0.5rem;">Tanggal yang dipilih</h3>
                <div id="selectedDateDisplay" style="color: #666; font-size: 1rem;">-</div>
                <div id="dateWarning" style="color: #EF4444; font-size: 0.875rem; margin-top: 0.25rem; display: none;">
                </div>
            </div>
            <a href="{{ route('user.rooms.booking', $room->id) }}" id="bookingButton"
                style="padding: 1rem 2.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 8px; text-decoration: none; font-weight: 600; display: inline-block;">
                Ajukan Peminjaman
            </a>
        </div>
    </div>

    <script>
        let selectedDate = null;
        let currentDate = new Date();
        const bookings = @json($bookings);
        const closures = @json($closures);
        const today = new Date();
        today.setHours(0, 0, 0, 0);

        // Group bookings by date and count
        function getBookingsForDate(dateStr) {
            return bookings.filter(b => b.booking_date === dateStr && b.status === 'approved');
        }

        function hasAnyBooking(dateStr) {
            return bookings.some(b => b.booking_date === dateStr && (b.status === 'approved' || b.status === 'pending'));
        }

        // Check if date is fully booked (assuming 8 hours operational, each booking is max duration)
        function isFullyBooked(dateStr) {
            const dayBookings = getBookingsForDate(dateStr);
            // Simple check: if there are 3+ approved bookings, consider it full
            // Or you can implement more sophisticated time slot checking
            return dayBookings.length >= 3;
        }

        // Check if date is closed
        function getClosureForDate(dateStr) {
            return closures.find(c => c.closure_date === dateStr && c.is_whole_day);
        }

        function isClosedForDate(dateStr) {
            return closures.some(c => c.closure_date === dateStr && c.is_whole_day);
        }

        function isSunday(year, month, day) {
            const date = new Date(year, month, day);
            const dayOfWeek = date.getDay();
            return dayOfWeek === 0; // 0 = Sunday only
        }

        function isPastDate(year, month, day) {
            const date = new Date(year, month, day);
            return date < today;
        }

        // H-2 rule: users can only book at least 2 days in advance
        function isWithinMinBookingDays(year, month, day) {
            const date = new Date(year, month, day);
            const minBookingDate = new Date(today);
            minBookingDate.setDate(minBookingDate.getDate() + 2); // H-2 = 2 days from now
            return date < minBookingDate;
        }

        function renderCalendar() {
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            document.getElementById('calendarMonth').textContent = monthNames[month] + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let html = '<table style="width: 100%; border-collapse: collapse;">';
            html += '<thead><tr>';
            ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'].forEach((day, index) => {
                const color = index === 6 ? '#EF4444' : '#666'; // Only Sunday is red
                html += `<th style="padding: 1rem; text-align: center; font-weight: 600; color: ${color};">${day}</th>`;
            });
            html += '</tr></thead><tbody><tr>';

            const startDay = firstDay === 0 ? 6 : firstDay - 1;
            for (let i = 0; i < startDay; i++) {
                html += '<td></td>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                let bgColor = '#10b981'; // Default: Green (available weekday)
                let textColor = 'white';
                let cursor = 'pointer';
                let isClickable = true;

                // Check if it's a past date
                if (isPastDate(year, month, day)) {
                    bgColor = '#e5e7eb';
                    textColor = '#9ca3af';
                    cursor = 'not-allowed';
                    isClickable = false;
                }
                // Check if within H-2 minimum booking days
                else if (isWithinMinBookingDays(year, month, day)) {
                    bgColor = '#f3f4f6'; // Light grey for H-2 blocked
                    textColor = '#9ca3af';
                    cursor = 'not-allowed';
                    isClickable = false;
                }
                // Check if Sunday (only Sunday is blocked)
                else if (isSunday(year, month, day)) {
                    bgColor = '#EF4444'; // Red
                    textColor = 'white';
                    cursor = 'not-allowed';
                    isClickable = false;
                }
                // Check if room is closed for this date
                else if (isClosedForDate(dateStr)) {
                    bgColor = '#991b1b'; // Dark red for closures
                    textColor = 'white';
                    cursor = 'not-allowed';
                    isClickable = false;
                }
                // Check if fully booked
                else if (isFullyBooked(dateStr)) {
                    bgColor = '#EF4444'; // Red
                    textColor = 'white';
                }
                // Check if has any approved booking (partial - show yellow)
                else if (hasAnyBooking(dateStr)) {
                    bgColor = '#F59E0B'; // Yellow
                    textColor = 'white';
                }
                // Otherwise green (available)

                const onclick = isClickable ? `onclick="selectDate('${dateStr}')"` : '';
                html += `<td ${onclick} style="padding: 1rem; text-align: center; cursor: ${cursor}; background: ${bgColor}; color: ${textColor}; border: 1px solid #f0f0f0; border-radius: 4px;">${day}</td>`;

                if ((startDay + day) % 7 === 0) html += '</tr><tr>';
            }

            html += '</tr></tbody></table>';
            document.getElementById('calendarTable').innerHTML = html;
        }

        function selectDate(dateStr) {
            const date = new Date(dateStr);
            const dayOfWeek = date.getDay();
            const warning = document.getElementById('dateWarning');
            const bookingButton = document.getElementById('bookingButton');

            // Check if Sunday (only Sunday is blocked)
            if (dayOfWeek === 0) {
                warning.textContent = 'Tidak dapat meminjam ruangan di hari Minggu';
                warning.style.display = 'block';
                bookingButton.style.pointerEvents = 'none';
                bookingButton.style.opacity = '0.5';
                return;
            }

            // Check if room is closed
            const closure = getClosureForDate(dateStr);
            if (closure) {
                warning.textContent = 'Ruangan tutup: ' + closure.reason;
                warning.style.display = 'block';
                bookingButton.style.pointerEvents = 'none';
                bookingButton.style.opacity = '0.5';
                return;
            }

            // Check if fully booked
            if (isFullyBooked(dateStr)) {
                warning.textContent = 'Tanggal ini sudah penuh';
                warning.style.display = 'block';
                bookingButton.style.pointerEvents = 'none';
                bookingButton.style.opacity = '0.5';
                return;
            }

            selectedDate = dateStr;
            warning.style.display = 'none';
            bookingButton.style.pointerEvents = 'auto';
            bookingButton.style.opacity = '1';

            document.getElementById('selectedDateDisplay').textContent = date.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            bookingButton.href = "{{ route('user.rooms.booking', $room->id) }}?date=" + dateStr;
        }

        function previousMonth() {
            currentDate.setMonth(currentDate.getMonth() - 1);
            renderCalendar();
        }

        function nextMonth() {
            currentDate.setMonth(currentDate.getMonth() + 1);
            renderCalendar();
        }

        renderCalendar();
    </script>
@endsection
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
                            $facilityIcons = [
                                'Wi-Fi' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0',
                                'WiFi' => 'M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0',
                                'AC' => 'M12 2v20M2 12h20',
                                'Proyektor' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2',
                                'Printer' => 'M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z',
                            ];
                        @endphp
                        @foreach($facilities as $facility)
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <div
                                    style="width: 40px; height: 40px; background: #E8F5E9; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                    <svg width="20" height="20" fill="none" stroke="#008080" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="{{ $facilityIcons[$facility] ?? 'M5 13l4 4L19 7' }}"></path>
                                    </svg>
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
                                {{ $room->contact_phone ?? '+62 812-3456-7890' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Right: Room Photo -->
                <div>
                    @if($room->image)
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                            style="width: 100%; height: 400px; object-fit: cover; border-radius: 12px; margin-bottom: 1rem;">
                    @else
                        <div
                            style="width: 100%; height: 400px; background: linear-gradient(135deg, #B8985F, #9d7d4b); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <svg width="80" height="80" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                    @endif

                    <!-- Photo thumbnails if multiple -->
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 0.5rem;">
                        @for($i = 0; $i < 4; $i++)
                            <div
                                style="width: 100%; height: 80px; background: #f0f0f0; border-radius: 8px; border: 2px solid {{ $i == 0 ? '#B8985F' : 'transparent' }}; overflow: hidden;">
                                @if($room->image && $i == 0)
                                    <img src="{{ asset('storage/' . $room->image) }}"
                                        style="width: 100%; height: 100%; object-fit: cover;">
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Calendar -->
        <div
            style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Kalender Booking</h2>
                <div style="display: flex; gap: 2rem; font-size: 0.875rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #10b981; border-radius: 4px;"></div>
                        <span>booked</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #F59E0B; border-radius: 4px;"></div>
                        <span>diproses</span>
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

        function renderCalendar() {
            const monthNames = ["November", "December", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October"];
            const year = currentDate.getFullYear();
            const month = currentDate.getMonth();

            document.getElementById('calendarMonth').textContent = monthNames[month] + ' ' + year;

            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            let html = '<table style="width: 100%; border-collapse: collapse;">';
            html += '<thead><tr>';
            ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'].forEach(day => {
                html += `<th style="padding: 1rem; text-align: center; font-weight: 600; color: #666;">${day}</th>`;
            });
            html += '</tr></thead><tbody><tr>';

            const startDay = firstDay === 0 ? 6 : firstDay - 1;
            for (let i = 0; i < startDay; i++) {
                html += '<td></td>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const booking = bookings.find(b => b.booking_date === dateStr);
                let bgColor = 'white';
                let textColor = '#1a1a1a';

                if (booking) {
                    if (booking.status === 'approved') {
                        bgColor = '#10b981';
                        textColor = 'white';
                    } else if (booking.status === 'pending') {
                        bgColor = '#F59E0B';
                        textColor = 'white';
                    }
                }

                html += `<td onclick="selectDate('${dateStr}')" style="padding: 1rem; text-align: center; cursor: pointer; background: ${bgColor}; color: ${textColor}; border: 1px solid #f0f0f0;">${day}</td>`;

                if ((startDay + day) % 7 === 0) html += '</tr><tr>';
            }

            html += '</tr></tbody></table>';
            document.getElementById('calendarTable').innerHTML = html;
        }

        function selectDate(dateStr) {
            selectedDate = dateStr;
            document.getElementById('selectedDateDisplay').textContent = new Date(dateStr).toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const bookingButton = document.getElementById('bookingButton');
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
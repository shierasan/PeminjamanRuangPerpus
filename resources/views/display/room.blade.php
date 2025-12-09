@extends('layouts.display')

@section('title', $room->name . ' - Monitor Peminjaman')

@section('styles')
    <style>
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--color-gold);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 1.5rem;
            transition: all 0.2s;
        }

        .back-link:hover {
            transform: translateX(-5px);
        }

        .room-header {
            background: linear-gradient(135deg, rgba(0, 128, 128, 0.4) 0%, rgba(0, 100, 100, 0.3) 100%);
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            border: 2px solid rgba(184, 152, 95, 0.3);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .room-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .room-icon-large {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--color-gold), var(--color-gold-light));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .room-details h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
        }

        .room-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 1rem;
            opacity: 0.8;
        }

        .room-meta span {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .display-grid {
            display: grid;
            grid-template-columns: 1fr 350px;
            gap: 2rem;
            max-width: 1600px;
            margin: 0 auto;
        }

        /* Bookings Section */
        .bookings-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sort-controls {
            display: flex;
            gap: 0.5rem;
        }

        .sort-btn {
            padding: 0.5rem 1rem;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            font-size: 0.875rem;
        }

        .sort-btn:hover,
        .sort-btn.active {
            background: var(--color-gold);
            color: var(--color-dark);
            border-color: var(--color-gold);
        }

        /* Booking Cards */
        .booking-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--color-gold);
            transition: all 0.3s;
            animation: fadeIn 0.5s ease forwards;
        }

        .booking-card:hover {
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .booking-card.ongoing {
            border-left-color: var(--color-success);
            background: rgba(16, 185, 129, 0.1);
        }

        .booking-card.upcoming {
            border-left-color: var(--color-info);
        }

        .booking-card.completed {
            border-left-color: #6b7280;
            opacity: 0.7;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .booking-time {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-gold);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .status-ongoing {
            background: rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        .status-ongoing .pulse-dot {
            width: 10px;
            height: 10px;
            background: #10b981;
            border-radius: 50%;
            animation: pulse 1.5s ease-in-out infinite;
        }

        .status-upcoming {
            background: rgba(59, 130, 246, 0.3);
            color: #3b82f6;
        }

        .status-completed {
            background: rgba(107, 114, 128, 0.3);
            color: #9ca3af;
        }

        .booking-user {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .booking-event {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 0.5rem;
        }

        .booking-organizer {
            font-size: 0.875rem;
            opacity: 0.6;
        }

        /* Calendar Section */
        .calendar-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            height: fit-content;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }

        .calendar-day-header {
            text-align: center;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.5rem;
            opacity: 0.7;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s;
            position: relative;
            background: rgba(255, 255, 255, 0.05);
        }

        .calendar-day:hover {
            background: rgba(184, 152, 95, 0.3);
        }

        .calendar-day.today {
            border: 2px solid var(--color-gold);
            font-weight: 700;
        }

        .calendar-day.selected {
            background: var(--color-gold);
            color: var(--color-dark);
            font-weight: 700;
        }

        .calendar-day.has-booking::after {
            content: '';
            position: absolute;
            bottom: 4px;
            width: 6px;
            height: 6px;
            background: var(--color-success);
            border-radius: 50%;
        }

        .calendar-day.empty {
            opacity: 0.3;
            cursor: default;
        }

        .calendar-day.sunday {
            background: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        .calendar-day.closed {
            background: rgba(239, 68, 68, 0.5);
            color: #fca5a5;
            cursor: not-allowed;
        }

        .calendar-day.sunday:hover,
        .calendar-day.closed:hover {
            background: rgba(239, 68, 68, 0.4);
        }

        .no-bookings {
            text-align: center;
            padding: 4rem 2rem;
            opacity: 0.6;
        }

        .no-bookings svg {
            width: 100px;
            height: 100px;
            margin-bottom: 1.5rem;
            opacity: 0.5;
        }

        .no-bookings p {
            font-size: 1.25rem;
        }

        @media (max-width: 1200px) {
            .display-grid {
                grid-template-columns: 1fr;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection

@section('content')
    <a href="{{ route('display.index', ['date' => $selectedDate]) }}" class="back-link">
        <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
        Kembali ke Daftar Ruangan
    </a>

    <div class="room-header fade-in">
        <div class="room-info">
            <div class="room-icon-large">
                <svg width="50" height="50" fill="none" stroke="#1a1a1a" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
            </div>
            <div class="room-details">
                <h1>{{ $room->name }}</h1>
                <div class="room-meta">
                    <span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16"></path>
                        </svg>
                        Lantai {{ $room->floor ?? '-' }}
                    </span>
                    <span>
                        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z">
                            </path>
                        </svg>
                        Kapasitas: {{ $room->capacity ?? '-' }} orang
                    </span>
                </div>
            </div>
        </div>
        <div style="text-align: center; padding: 1rem 2rem; background: rgba(255,255,255,0.1); border-radius: 12px;">
            <div style="font-size: 0.875rem; opacity: 0.7;">Tanggal Dipilih</div>
            <div style="font-size: 1.5rem; font-weight: 700; color: var(--color-gold);">
                {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
            </div>
        </div>
    </div>

    <div class="display-grid">
        <!-- Bookings Section -->
        <div class="bookings-section fade-in">
            <div class="section-header">
                <div class="section-title">
                    <svg width="24" height="24" fill="none" stroke="var(--color-gold)" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                        </path>
                    </svg>
                    Daftar Peminjaman
                </div>
                <div class="sort-controls">
                    <a href="{{ route('display.room', ['id' => $room->id, 'date' => $selectedDate, 'sort' => 'asc']) }}"
                        class="sort-btn {{ $sortBy === 'asc' ? 'active' : '' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7"></path>
                        </svg>
                        Paling Awal
                    </a>
                    <a href="{{ route('display.room', ['id' => $room->id, 'date' => $selectedDate, 'sort' => 'desc']) }}"
                        class="sort-btn {{ $sortBy === 'desc' ? 'active' : '' }}">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        Paling Akhir
                    </a>
                </div>
            </div>

            @if($bookings->count() > 0)
                @foreach($bookings as $index => $booking)
                    @php
                        $now = now();
                        $start = \Carbon\Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->start_time);
                        $end = \Carbon\Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->end_time);

                        if ($now->gt($end) || $booking->completed_at) {
                            $status = 'completed';
                            $statusText = '✓ Selesai';
                        } elseif ($now->between($start, $end)) {
                            $status = 'ongoing';
                            $statusText = 'Sedang Berlangsung';
                        } else {
                            $status = 'upcoming';
                            $statusText = 'Akan Datang';
                        }
                    @endphp
                    <div class="booking-card {{ $status }}" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="booking-header">
                            <div class="booking-time">
                                <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ date('H:i', strtotime($booking->start_time)) }} -
                                {{ date('H:i', strtotime($booking->end_time)) }}
                            </div>
                            <span class="status-badge status-{{ $status }}">
                                @if($status === 'ongoing')
                                    <span class="pulse-dot"></span>
                                @endif
                                {{ $statusText }}
                            </span>
                        </div>
                        <div class="booking-user"><svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg> {{ $booking->user->name ?? 'Unknown' }}</div>
                        @if($booking->event_name)
                            <div class="booking-event"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path></svg> {{ $booking->event_name }}</div>
                        @endif
                        @if($booking->organizer)
                            <div class="booking-organizer"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: inline; vertical-align: middle; margin-right: 4px;"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"></path></svg> Penyelenggara: {{ $booking->organizer }}</div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="no-bookings">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Tidak ada peminjaman pada tanggal ini</p>
                </div>
            @endif
        </div>

        <!-- Calendar Section -->
        <div class="calendar-section fade-in" style="animation-delay: 0.2s;">
            <div
                style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="var(--color-gold)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Pilih Tanggal
            </div>
            <div id="calendar"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        const bookedDates = @json($bookedDates);
        const closedDates = @json($closedDates);
        const selectedDate = '{{ $selectedDate }}';
        const roomId = {{ $room->id }};
        let currentMonth = new Date('{{ $selectedDate }}');

        function isSunday(date) {
            return date.getDay() === 0;
        }

        function isClosed(dateStr) {
            return closedDates.includes(dateStr);
        }

        function renderCalendar() {
            const calendar = document.getElementById('calendar');
            const year = currentMonth.getFullYear();
            const month = currentMonth.getMonth();

            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startDay = firstDay.getDay();
            const totalDays = lastDay.getDate();

            const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

            let html = `
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                        <button onclick="prevMonth()" style="background: rgba(255,255,255,0.1); border: none; color: white; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer;">←</button>
                        <span style="font-weight: 600;">${monthNames[month]} ${year}</span>
                        <button onclick="nextMonth()" style="background: rgba(255,255,255,0.1); border: none; color: white; padding: 0.5rem 1rem; border-radius: 8px; cursor: pointer;">→</button>
                    </div>
                    <div class="calendar-grid">
                        <div class="calendar-day-header" style="color: #fca5a5;">Min</div>
                        <div class="calendar-day-header">Sen</div>
                        <div class="calendar-day-header">Sel</div>
                        <div class="calendar-day-header">Rab</div>
                        <div class="calendar-day-header">Kam</div>
                        <div class="calendar-day-header">Jum</div>
                        <div class="calendar-day-header">Sab</div>
                `;

            for (let i = 0; i < startDay; i++) {
                html += '<div class="calendar-day empty"></div>';
            }

            const today = new Date();
            today.setHours(0, 0, 0, 0);

            for (let day = 1; day <= totalDays; day++) {
                const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const date = new Date(year, month, day);

                let classes = 'calendar-day';
                if (date.getTime() === today.getTime()) classes += ' today';
                if (dateStr === selectedDate) classes += ' selected';
                if (isSunday(date)) classes += ' sunday';
                if (isClosed(dateStr)) classes += ' closed';
                if (bookedDates[dateStr]) classes += ' has-booking';

                html += `<div class="${classes}" onclick="selectDate('${dateStr}')">${day}</div>`;
            }

            html += '</div>';
            calendar.innerHTML = html;
        }

        function prevMonth() {
            currentMonth.setMonth(currentMonth.getMonth() - 1);
            renderCalendar();
        }

        function nextMonth() {
            currentMonth.setMonth(currentMonth.getMonth() + 1);
            renderCalendar();
        }

        function selectDate(dateStr) {
            window.location.href = '{{ route("display.room", ["id" => $room->id]) }}?date=' + dateStr;
        }

        renderCalendar();
    </script>
@endsection
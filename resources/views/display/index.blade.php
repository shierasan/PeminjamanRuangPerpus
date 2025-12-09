@extends('layouts.display')

@section('title', 'Monitor Peminjaman Ruangan - SIPRUS')

@section('styles')
<style>
    .page-title {
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-title h1 {
        font-size: 2rem;
        font-weight: 800;
        color: var(--color-teal);
        margin-bottom: 0.5rem;
    }

    .page-title p {
        font-size: 1rem;
        color: var(--color-text-light);
    }

    .display-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Rooms Grid */
    .rooms-section {
        background: var(--color-white);
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 2px solid var(--color-primary);
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.25rem;
    }

    .room-card {
        background: var(--color-white);
        border-radius: 12px;
        padding: 1.25rem;
        border: 2px solid var(--color-teal);
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
        color: inherit;
        display: block;
        box-shadow: 0 3px 12px rgba(0, 139, 92, 0.1);
    }

    .room-card:hover {
        transform: translateY(-4px);
        border-color: var(--color-primary);
        box-shadow: 0 10px 30px rgba(184, 152, 95, 0.2);
        background: linear-gradient(135deg, rgba(0, 139, 92, 0.05) 0%, rgba(184, 152, 95, 0.05) 100%);
    }

    .room-card-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .room-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--color-teal), var(--color-teal-dark));
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid var(--color-primary);
    }

    .room-name {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--color-dark);
    }

    .room-floor {
        font-size: 0.8rem;
        color: var(--color-text-light);
    }

    .room-stats {
        display: flex;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .room-stat {
        flex: 1;
        background: linear-gradient(135deg, var(--color-teal), var(--color-teal-dark));
        padding: 0.6rem;
        border-radius: 8px;
        text-align: center;
        border: 1px solid rgba(0, 139, 92, 0.3);
    }

    .room-stat-value {
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
    }

    .room-stat-label {
        font-size: 0.7rem;
        color: rgba(255, 255, 255, 0.9);
    }

    /* Calendar Section */
    .calendar-section {
        background: var(--color-white);
        border-radius: 16px;
        padding: 1.25rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 2px solid var(--color-primary);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .calendar-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--color-dark);
    }

    .calendar-nav {
        display: flex;
        gap: 0.5rem;
    }

    .calendar-nav button {
        background: var(--color-secondary);
        border: none;
        color: var(--color-text);
        padding: 0.4rem 0.75rem;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.2s;
    }

    .calendar-nav button:hover {
        background: var(--color-primary);
        color: white;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 3px;
    }

    .calendar-day-header {
        text-align: center;
        font-size: 0.7rem;
        font-weight: 600;
        padding: 0.4rem;
        color: var(--color-text-light);
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
        background: var(--color-secondary);
        color: var(--color-text);
    }

    .calendar-day:hover {
        background: rgba(184, 152, 95, 0.2);
    }

    .calendar-day.today {
        border: 2px solid var(--color-teal);
        font-weight: 700;
    }

    .calendar-day.selected {
        background: var(--color-teal);
        color: white;
        font-weight: 700;
    }

    .calendar-day.has-booking::after {
        content: '';
        position: absolute;
        bottom: 3px;
        width: 5px;
        height: 5px;
        background: var(--color-success);
        border-radius: 50%;
    }

    .calendar-day.empty {
        opacity: 0.3;
        cursor: default;
    }

    .calendar-day.sunday {
        background: rgba(239, 68, 68, 0.15);
        color: #dc2626;
    }

    .calendar-day.closed {
        background: rgba(239, 68, 68, 0.25);
        color: #dc2626;
        cursor: not-allowed;
    }

    .calendar-day.sunday:hover,
    .calendar-day.closed:hover {
        background: rgba(239, 68, 68, 0.2);
    }

    /* Bookings Table */
    .bookings-section {
        margin-top: 2rem;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .bookings-table {
        width: 100%;
        border-collapse: collapse;
    }

    .bookings-table th {
        background: rgba(184, 152, 95, 0.3);
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .bookings-table td {
        padding: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .bookings-table tr:hover td {
        background: rgba(255, 255, 255, 0.05);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        padding: 0.375rem 0.75rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-ongoing {
        background: rgba(16, 185, 129, 0.2);
        color: #10b981;
        animation: pulse 2s ease-in-out infinite;
    }

    .status-upcoming {
        background: rgba(59, 130, 246, 0.2);
        color: #3b82f6;
    }

    .status-completed {
        background: rgba(107, 114, 128, 0.3);
        color: #9ca3af;
    }

    .no-bookings {
        text-align: center;
        padding: 3rem;
        opacity: 0.6;
    }

    .no-bookings svg {
        width: 80px;
        height: 80px;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    @media (max-width: 1200px) {
        .display-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="page-title fade-in">
    <h1>Monitor Peminjaman Ruangan</h1>
    <p>Klik ruangan untuk melihat detail peminjaman</p>
</div>

<div class="display-grid">
    <!-- Rooms Section -->
    <div class="rooms-section fade-in">
        <div class="rooms-grid">
            @foreach($rooms as $room)
                @php
                    $roomBookingsToday = $bookings->where('room_id', $room->id);
                    $currentBooking = $roomBookingsToday->first(function($b) {
                        $now = now();
                        $start = \Carbon\Carbon::parse($b->booking_date->format('Y-m-d') . ' ' . $b->start_time);
                        $end = \Carbon\Carbon::parse($b->booking_date->format('Y-m-d') . ' ' . $b->end_time);
                        return $now->between($start, $end);
                    });
                @endphp
                <a href="{{ route('display.room', ['id' => $room->id, 'date' => $selectedDate]) }}" class="room-card">
                    <div class="room-card-header">
                        <div class="room-icon">
                            <svg width="32" height="32" fill="none" stroke="#1a1a1a" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="room-name">{{ $room->name }}</div>
                            <div class="room-floor">Lantai {{ $room->floor ?? '-' }}</div>
                        </div>
                    </div>
                    <div class="room-stats">
                        <div class="room-stat">
                            <div class="room-stat-value">{{ $room->capacity ?? '-' }}</div>
                            <div class="room-stat-label">Kapasitas</div>
                        </div>
                        <div class="room-stat">
                            <div class="room-stat-value">{{ $roomBookingsToday->count() }}</div>
                            <div class="room-stat-label">Booking Hari Ini</div>
                        </div>
                    </div>
                    @if($currentBooking)
                        <div style="margin-top: 1rem; padding: 0.75rem; background: rgba(16, 185, 129, 0.2); border-radius: 8px; border-left: 3px solid #10b981;">
                            <div style="font-size: 0.75rem; opacity: 0.8;">Sedang Digunakan</div>
                            <div style="font-weight: 600;">{{ $currentBooking->user->name ?? 'Unknown' }}</div>
                        </div>
                    @endif
                </a>
            @endforeach
        </div>
    </div>

    <!-- Calendar Section -->
    <div class="calendar-section fade-in" style="animation-delay: 0.2s;">
        <div class="calendar-header">
            <div class="calendar-title" style="display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="var(--color-gold)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Pilih Tanggal
            </div>
        </div>
        <div id="calendar"></div>
        
        <!-- Today's Bookings Summary -->
        <div class="bookings-section">
            <div class="section-title" style="display: flex; align-items: center; gap: 0.5rem;">
                <svg width="20" height="20" fill="none" stroke="var(--color-gold)" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                Peminjaman {{ \Carbon\Carbon::parse($selectedDate)->format('d M Y') }}
            </div>
            
            @if($bookings->count() > 0)
                <div style="max-height: 300px; overflow-y: auto;">
                    @foreach($bookings as $booking)
                        @php
                            $now = now();
                            $start = \Carbon\Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->start_time);
                            $end = \Carbon\Carbon::parse($booking->booking_date->format('Y-m-d') . ' ' . $booking->end_time);
                            
                            if ($now->gt($end) || $booking->completed_at) {
                                $status = 'completed';
                                $statusText = 'Selesai';
                            } elseif ($now->between($start, $end)) {
                                $status = 'ongoing';
                                $statusText = 'Berlangsung';
                            } else {
                                $status = 'upcoming';
                                $statusText = 'Akan Datang';
                            }
                        @endphp
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem; background: rgba(255,255,255,0.05); border-radius: 8px; margin-bottom: 0.5rem;">
                            <div>
                                <div style="font-weight: 600; font-size: 0.875rem;">{{ $booking->room->name }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.7;">{{ date('H:i', strtotime($booking->start_time)) }} - {{ date('H:i', strtotime($booking->end_time)) }}</div>
                            </div>
                            <span class="status-badge status-{{ $status }}">
                                @if($status === 'ongoing')
                                    <span style="width: 8px; height: 8px; background: currentColor; border-radius: 50%;"></span>
                                @endif
                                {{ $statusText }}
                            </span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="no-bookings">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p>Tidak ada peminjaman</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const bookedDates = @json($bookedDates);
    const closedDates = @json($closedDates);
    const selectedDate = '{{ $selectedDate }}';
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
        
        // Empty cells before first day
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
        window.location.href = '{{ route("display.index") }}?date=' + dateStr;
    }

    renderCalendar();
</script>
@endsection

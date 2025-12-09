@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 900px;">

        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 2rem; flex-wrap: wrap; gap: 1rem;">
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem 0; color: #1a1a1a;">
                        Notifikasi
                    </h1>
                    <p style="color: #666; margin: 0;">
                        Pemberitahuan terkait peminjaman ruangan di SIPRUS.
                    </p>
                </div>

                <!-- Filters -->
                <form method="GET" action="{{ route('admin.notifications') }}" id="filterForm"
                    style="display: flex; gap: 0.75rem; flex-wrap: wrap; align-items: center;">
                    
                    <!-- Read Status Filter -->
                    <select name="status" onchange="document.getElementById('filterForm').submit()"
                        style="padding: 0.5rem 1rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer; font-size: 0.8125rem;">
                        <option value="">Semua Status</option>
                        <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                        <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                    </select>

                    <!-- Type Filter -->
                    <select name="type" onchange="document.getElementById('filterForm').submit()"
                        style="padding: 0.5rem 1rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer; font-size: 0.8125rem;">
                        <option value="">Semua Jenis</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ request('type') === $type ? 'selected' : '' }}>
                                @switch($type)
                                    @case('new_booking')
                                        Pengajuan Baru
                                        @break
                                    @case('booking_cancelled')
                                        Pembatalan
                                        @break
                                    @case('aspiration')
                                        Aspirasi
                                        @break
                                    @case('booking_completed')
                                        Peminjaman Selesai
                                        @break
                                    @default
                                        {{ ucfirst(str_replace('_', ' ', $type)) }}
                                @endswitch
                            </option>
                        @endforeach
                    </select>

                    <!-- Sort -->
                    <select name="sort" onchange="document.getElementById('filterForm').submit()"
                        style="padding: 0.5rem 1rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer; font-size: 0.8125rem;">
                        <option value="desc" {{ request('sort', 'desc') === 'desc' ? 'selected' : '' }}>Terbaru</option>
                        <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Terlama</option>
                    </select>
                </form>
            </div>

            <!-- Notifications List -->
            @if($notifications->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($notifications as $notification)
                        <a href="{{ route('admin.notifications.read', $notification->id) }}"
                            style="text-decoration: none; color: inherit;">
                            <div style="display: flex; align-items: start; gap: 1.5rem; padding: 1.5rem; background: {{ $notification->is_read ? 'white' : '#fffbeb' }}; border-radius: 12px; border: 2px solid {{ $notification->is_read ? '#f0f0f0' : '#f59e0b' }}; cursor: pointer; transition: all 0.2s; position: relative;"
                                onmouseover="this.style.background='#f5f5f5'; this.style.borderColor='#d1d5db'"
                                onmouseout="this.style.background='{{ $notification->is_read ? 'white' : '#fffbeb' }}'; this.style.borderColor='{{ $notification->is_read ? '#f0f0f0' : '#f59e0b' }}'">
                                
                                <!-- Unread Badge -->
                                @if(!$notification->is_read)
                                    <div style="position: absolute; top: -8px; right: -8px; background: #f59e0b; color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
                                        Baru
                                    </div>
                                @endif

                                <!-- Icon -->
                                <div style="width: 50px; height: 50px; background: {{ $notification->is_read ? '#e5e7eb' : '#fef3c7' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    @if($notification->type === 'new_booking')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#d97706' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    @elseif($notification->type === 'booking_cancelled')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#d97706' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    @elseif($notification->type === 'aspiration')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#d97706' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                        </svg>
                                    @elseif($notification->type === 'booking_completed')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#10b981' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @else
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#d97706' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                        <h3 style="font-weight: 700; margin: 0; color: #1a1a1a; {{ !$notification->is_read ? 'color: #92400e;' : '' }}">
                                            {{ $notification->title }}
                                        </h3>
                                        @if($notification->is_read)
                                            <span style="font-size: 0.75rem; color: #10b981; display: flex; align-items: center; gap: 0.25rem;">
                                                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                Sudah dibaca
                                            </span>
                                        @endif
                                    </div>
                                    @if($notification->message)
                                        <p style="font-size: 0.875rem; color: #6b7280; margin: 0 0 0.5rem 0; line-height: 1.5;">
                                            {{ Str::limit($notification->message, 100) }}
                                        </p>
                                    @endif
                                    <div style="font-size: 0.8125rem; color: #999;">
                                        {{ $notification->created_at->format('d M Y, H:i') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 4rem 2rem;">
                    <svg width="80" height="80" fill="none" stroke="#ccc" style="margin: 0 auto 1rem;" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <p style="color: #999; font-size: 1.125rem;">Belum ada notifikasi</p>
                </div>
            @endif
        </div>
    </div>
@endsection

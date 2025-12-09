@extends('layouts.user')

@section('title', 'Notifikasi')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 900px;">

        @if(session('error'))
            <div style="background: #FEE2E2; border: 1px solid #FECACA; color: #DC2626; padding: 1rem 1.5rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

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
                <form method="GET" action="{{ route('user.notifications') }}" id="filterForm"
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
                                    @case('booking_approved')
                                        Disetujui
                                        @break
                                    @case('booking_rejected')
                                        Ditolak
                                        @break
                                    @case('cancellation_approved')
                                        Pembatalan Disetujui
                                        @break
                                    @case('cancellation_rejected')
                                        Pembatalan Ditolak
                                        @break
                                    @case('key_returned')
                                        Kunci Dikembalikan
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
                        <a href="{{ route('user.notifications.read', $notification->id) }}"
                            style="text-decoration: none; color: inherit;">
                            <div style="display: flex; align-items: start; gap: 1.5rem; padding: 1.5rem; background: {{ $notification->is_read ? 'white' : '#ecfdf5' }}; border-radius: 12px; border: 2px solid {{ $notification->is_read ? '#f0f0f0' : '#10b981' }}; cursor: pointer; transition: all 0.2s; position: relative;"
                                onmouseover="this.style.background='#f5f5f5'; this.style.borderColor='#d1d5db'"
                                onmouseout="this.style.background='{{ $notification->is_read ? 'white' : '#ecfdf5' }}'; this.style.borderColor='{{ $notification->is_read ? '#f0f0f0' : '#10b981' }}'">
                                
                                <!-- Unread Badge -->
                                @if(!$notification->is_read)
                                    <div style="position: absolute; top: -8px; right: -8px; background: #10b981; color: white; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600;">
                                        Baru
                                    </div>
                                @endif

                                <!-- Icon -->
                                <div style="width: 50px; height: 50px; background: {{ $notification->is_read ? '#e5e7eb' : '#d1fae5' }}; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    @if($notification->type === 'booking_approved')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#059669' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    @elseif($notification->type === 'booking_rejected')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#dc2626' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    @elseif($notification->type === 'cancellation_approved' || $notification->type === 'cancellation_rejected')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#f59e0b' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                    @elseif($notification->type === 'key_returned')
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#059669' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                    @else
                                        <svg width="24" height="24" fill="none" stroke="{{ $notification->is_read ? '#6b7280' : '#059669' }}" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    @endif
                                </div>

                                <!-- Content -->
                                <div style="flex: 1;">
                                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.5rem;">
                                        <h3 style="font-weight: 700; margin: 0; color: {{ !$notification->is_read ? '#065f46' : '#1a1a1a' }};">
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
                                            {{ Str::limit($notification->message, 120) }}
                                        </p>
                                    @endif
                                    <div style="font-size: 0.8125rem; color: #999;">
                                        {{ $notification->created_at->diffForHumans() }} • {{ $notification->created_at->format('d M Y, H:i') }}
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

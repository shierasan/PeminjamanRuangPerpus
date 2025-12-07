@extends('layouts.app')

@section('title', 'Notifikasi')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 900px;">

        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="margin-bottom: 2rem;">
                <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem 0; color: #1a1a1a;">
                    Notifikasi
                </h1>
                <p style="color: #666; margin: 0;">
                    Pemberitahuan terkait peminjaman ruangan di Perpustakaan Universitas Andalas.
                </p>
            </div>

            <!-- Notifications List -->
            @if($notifications->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($notifications as $notification)
                        <a href="{{ route('admin.notifications.read', $notification->id) }}"
                            style="text-decoration: none; color: inherit;">
                            <div style="display: flex; align-items: start; gap: 1.5rem; padding: 1.5rem; background: {{ $notification->is_read ? 'white' : '#f9fafb' }}; border-radius: 12px; border: 1px solid #f0f0f0; cursor: pointer; transition: all 0.2s;"
                                onmouseover="this.style.background='#f5f5f5'"
                                onmouseout="this.style.background='{{ $notification->is_read ? 'white' : '#f9fafb' }}'">
                                <!-- Icon -->
                                <div
                                    style="width: 50px; height: 50px; background: #e5e7eb; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="24" height="24" fill="none" stroke="#6b7280" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <div style="flex: 1;">
                                    <h3 style="font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a;">
                                        {{ $notification->title }}
                                    </h3>
                                    <div style="font-size: 0.875rem; color: #999;">
                                        {{ $notification->created_at->format('d M Y') }}
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
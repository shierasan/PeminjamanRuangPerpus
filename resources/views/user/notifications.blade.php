@extends('layouts.user')

@section('title', 'Notifikasi')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 900px;">

        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0 0 0.5rem 0; color: #1a1a1a;">
                        Notifikasi
                    </h1>
                    <p style="color: #666; margin: 0;">
                        Pemberitahuan terkait peminjaman ruangan di Perpustakaan Universitas Andalas.
                    </p>
                </div>

                <select id="filterCategory"
                    style="padding: 0.75rem 1.5rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer;">
                    <option value="all">Pilih Kategori</option>
                    <option value="all">Semua</option>
                    <option value="pending">Menunggu</option>
                    <option value="rejected">Ditolak</option>
                    <option value="approved">Diterima</option>
                </select>
            </div>

            <!-- Notifications List -->
            @if($notifications->count() > 0)
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    @foreach($notifications as $notification)
                        <a href="{{ route('user.notifications.read', $notification->id) }}"
                            style="text-decoration: none; color: inherit;">
                            <div class="notification-item" data-type="{{ $notification->type }}"
                                style="display: flex; align-items: start; gap: 1.5rem; padding: 1.5rem; background: {{ $notification->is_read ? 'white' : '#FFF9E6' }}; border-radius: 12px; border: 1px solid #f0f0f0; cursor: pointer; transition: all 0.2s;"
                                onmouseover="this.style.background='#f5f5f5'"
                                onmouseout="this.style.background='{{ $notification->is_read ? 'white' : '#FFF9E6' }}'">
                                <!-- Icon -->
                                <div
                                    style="width: 50px; height: 50px; background: #E8F5E9; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <svg width="24" height="24" fill="none" stroke="#008080" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>

                                <!-- Content -->
                                <div style="flex: 1;">
                                    <h3 style="font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a;">
                                        {{ $notification->title }}
                                    </h3>
                                    <p style="color: #666; font-size: 0.875rem; margin-bottom: 0.75rem;">
                                        {{ $notification->message }}
                                    </p>
                                    <div style="font-size: 0.75rem; color: #999;">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div
                                    style="padding: 0.25rem 0.75rem; background: {{ $notification->is_read ? '#e5e7eb' : '#10b981' }}; color: {{ $notification->is_read ? '#6b7280' : 'white' }}; border-radius: 6px; font-size: 0.75rem; font-weight: 600; white-space: nowrap;">
                                    {{ $notification->is_read ? 'Sudah Dibaca' : 'Belum Dibaca' }}
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

    <script>
        document.getElementById('filterCategory').addEventListener('change', function () {
            const selectedType = this.value;
            const notifications = document.querySelectorAll('.notification-item');

            notifications.forEach(notification => {
                const notifType = notification.getAttribute('data-type');
                const parentLink = notification.parentElement;

                if (selectedType === 'all') {
                    parentLink.style.display = 'block';
                } else if (selectedType === 'pending' && notifType === 'booking_submitted') {
                    parentLink.style.display = 'block';
                } else if (selectedType === 'rejected' && notifType === 'booking_rejected') {
                    parentLink.style.display = 'block';
                } else if (selectedType === 'approved' && notifType === 'booking_approved') {
                    parentLink.style.display = 'block';
                } else {
                    parentLink.style.display = 'none';
                }
            });
        });
    </script>
@endsection
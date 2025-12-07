@extends('layouts.app')

@section('title', 'Penutupan Ruangan - Admin')

@section('content')
    <div class="container" style="max-width: 1000px; margin: 0 auto; padding: 1.5rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <div>
                    <h1 style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.25rem;">
                        Penutupan Ruangan
                    </h1>
                    <p style="color: #666; font-size: 0.9rem;">
                        Kelola jadwal penutupan ruangan untuk maintenance atau event khusus
                    </p>
                </div>
                <a href="{{ route('admin.closures.create') }}"
                    style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
                    <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Tambah Penutupan
                </a>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div style="background: #d1fae5; border: 1px solid #34d399; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Closures List --}}
            @if($closures->count() > 0)
                <div style="overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr style="background: #f9fafb; border-bottom: 2px solid #e5e7eb;">
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Ruangan</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Tanggal</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Waktu</th>
                                <th style="padding: 1rem; text-align: left; font-weight: 600; color: #374151;">Alasan</th>
                                <th style="padding: 1rem; text-align: center; font-weight: 600; color: #374151;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($closures as $closure)
                                <tr style="border-bottom: 1px solid #e5e7eb;">
                                    <td style="padding: 1rem;">
                                        @if($closure->room)
                                            <span style="font-weight: 500;">{{ $closure->room->name }}</span>
                                        @else
                                            <span style="background: #fef3c7; color: #92400e; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600;">
                                                Semua Ruangan
                                            </span>
                                        @endif
                                    </td>
                                    <td style="padding: 1rem;">
                                        {{ $closure->closure_date->format('d M Y') }}
                                    </td>
                                    <td style="padding: 1rem;">
                                        @if($closure->isWholeDay())
                                            <span style="color: #ef4444; font-weight: 500;">Seharian</span>
                                        @else
                                            {{ \Carbon\Carbon::parse($closure->start_time)->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($closure->end_time)->format('H:i') }}
                                        @endif
                                    </td>
                                    <td style="padding: 1rem; color: #666;">
                                        {{ $closure->reason }}
                                    </td>
                                    <td style="padding: 1rem; text-align: center;">
                                        <form action="{{ route('admin.closures.destroy', $closure) }}" method="POST"
                                            onsubmit="return confirm('Hapus penutupan ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                style="background: #fee2e2; color: #dc2626; border: none; padding: 0.5rem 1rem; border-radius: 6px; cursor: pointer; font-size: 0.875rem; font-weight: 500;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div style="margin-top: 1.5rem; display: flex; justify-content: center;">
                    {{ $closures->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 3rem; color: #666;">
                    <svg width="64" height="64" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 1rem; opacity: 0.5;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <p style="font-size: 1rem;">Belum ada jadwal penutupan ruangan</p>
                    <a href="{{ route('admin.closures.create') }}" style="color: #B8985F; font-weight: 500;">
                        Tambahkan penutupan pertama »
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

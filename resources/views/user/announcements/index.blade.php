@extends('layouts.user')

@section('title', 'Pengumuman')

@section('content')
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Informasi</h1>

            {{-- Title Section --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #B8985F; margin-bottom: 0.5rem;">Pengumuman</h2>
                <p style="color: #666; font-size: 0.95rem;">Dapatkan update penting mengenai layanan dan penggunaan ruangan
                    di sini.</p>
            </div>

            {{-- Search Box --}}
            <form action="{{ route('user.announcements.index') }}" method="GET" style="margin-bottom: 2rem;">
                <div style="background: #FFF9E6; border: 1px solid #E6D5A8; border-radius: 12px; padding: 1.5rem;">
                    <label
                        style="display: block; font-size: 0.875rem; color: #666; margin-bottom: 0.5rem;">Pencarian</label>
                    <div style="display: flex; gap: 0.75rem;">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari berdasarkan kata kunci atau isi pengumuman"
                            style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                        <button type="submit"
                            style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                            Cari
                        </button>
                    </div>
                </div>
            </form>

            {{-- Announcements List --}}
            <div>
                @forelse($announcements as $announcement)
                    <div
                        style="border: 1px solid #e0e0e0; border-radius: 12px; padding: 1.5rem; margin-bottom: 1rem; background: white;">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 0.75rem;">
                            <h3 style="font-size: 1.1rem; font-weight: 600; color: #1a1a1a; margin: 0; flex: 1;">
                                {{ $announcement->title }}
                            </h3>
                            <span style="font-size: 0.875rem; color: #999; white-space: nowrap; margin-left: 1rem;">
                                {{ $announcement->published_date->format('d M Y') }}
                            </span>
                        </div>
                        <p style="color: #666; font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                            {{ Str::limit($announcement->content, 150) }}
                        </p>
                        <div style="text-align: right;">
                            <a href="{{ route('user.announcements.show', $announcement->id) }}"
                                style="color: #B8985F; font-size: 0.9rem; text-decoration: none; font-weight: 500;">
                                Baca Selengkapnya »
                            </a>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: 3rem; color: #999;">
                        <svg style="width: 64px; height: 64px; margin: 0 auto 1rem; color: #ddd;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z">
                            </path>
                        </svg>
                        <p style="font-size: 1.1rem;">Belum ada pengumuman</p>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($announcements->hasPages())
                <div style="margin-top: 2rem;">
                    {{ $announcements->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('title', 'Tambah Pengumuman')

@section('content')
    <div class="container" style="max-width: 800px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 style="font-size: 1.5rem; font-weight: 700; color: #1a1a1a;">Form Tambah Pengumuman</h1>
                <a href="{{ route('admin.announcements.index') }}"
                    style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; color: #374151; text-decoration: none; font-size: 0.875rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            <form action="{{ route('admin.announcements.store') }}" method="POST">
                @csrf

                {{-- Judul --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">Judul Pengumuman
                        *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    @error('title')
                        <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">Tanggal
                        Publikasi *</label>
                    <input type="date" name="published_date" value="{{ old('published_date', date('Y-m-d')) }}" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;">
                    @error('published_date')
                        <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Isi --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #374151;">Isi Pengumuman
                        *</label>
                    <textarea name="content" rows="8" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem; resize: vertical;">{{ old('content') }}</textarea>
                    @error('content')
                        <span style="color: #ef4444; font-size: 0.875rem;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Checkbox --}}
                <div style="margin-bottom: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                        <input type="checkbox" name="is_active" value="1" checked style="width: 18px; height: 18px;">
                        <span style="color: #374151;">Aktifkan pengumuman (akan ditampilkan di halaman utama)</span>
                    </label>
                </div>

                {{-- Buttons --}}
                <div style="display: flex; gap: 1rem;">
                    <button type="submit"
                        style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; font-size: 1rem;">
                        Simpan Pengumuman
                    </button>
                    <a href="{{ route('admin.announcements.index') }}"
                        style="padding: 0.75rem 2rem; border: 1px solid #d1d5db; border-radius: 8px; color: #374151; text-decoration: none; font-weight: 500;">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
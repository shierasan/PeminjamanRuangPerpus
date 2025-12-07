@extends('layouts.admin')

@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')

@section('content')
<div class="table-container" style="max-width: 800px;">
    <div class="table-header">
        <h3 class="table-title">Form Edit Pengumuman</h3>
        <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline btn-sm">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                </path>
            </svg>
            Kembali
        </a>
    </div>

    <div style="padding: 2rem;">
        <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Judul Pengumuman *</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                    value="{{ old('title', $announcement->title) }}" required>
                @error('title')
                    <span class="form-text" style="color: #EF4444;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="published_date">Tanggal Publikasi *</label>
                <input type="date" class="form-control @error('published_date') is-invalid @enderror"
                    id="published_date" name="published_date"
                    value="{{ old('published_date', $announcement->published_date->format('Y-m-d')) }}" required>
                @error('published_date')
                    <span class="form-text" style="color: #EF4444;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Isi Pengumuman *</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content"
                    rows="8" required>{{ old('content', $announcement->content) }}</textarea>
                @error('content')
                    <span class="form-text" style="color: #EF4444;">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-checkbox">
                <input type="checkbox" id="is_active" name="is_active" value="1"
                    {{ old('is_active', $announcement->is_active) ? 'checked' : '' }}>
                <label for="is_active">Aktifkan pengumuman (akan ditampilkan di halaman utama)</label>
            </div>

            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary">
                    <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Pengumuman
                </button>
                <a href="{{ route('admin.announcements.index') }}" class="btn btn-outline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

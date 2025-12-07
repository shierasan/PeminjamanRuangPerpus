@extends('layouts.app')

@section('title', 'Detail Aspirasi & Pengaduan')

@section('content')
    <div style="padding: 2rem 4rem; min-height: 100vh; background: #f5f5f5;">
        <div style="max-width: 700px; margin: 0 auto;">
            <!-- White Card Container -->
            <div style="background: white; border-radius: 16px; padding: 2.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">

                <!-- Header -->
                <div style="margin-bottom: 2rem;">
                    <h1 style="font-size: 1.5rem; font-weight: 700; color: #000; margin-bottom: 0.5rem;">
                        Form Aspirasi dan Pengaduan
                    </h1>
                </div>

                <!-- Nama Pengirim -->
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Nama Pengirim
                    </h3>
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; background: #F9FAFB; padding: 0.875rem 1rem; border-radius: 8px; border: 1px solid #E5E7EB;">
                        <span style="color: #1a1a1a; font-weight: 500;">{{ $aspiration->user->name }}</span>
                        <span style="color: #6B7280; font-size: 0.875rem;">{{ $aspiration->user->email }}</span>
                    </div>
                </div>

                <!-- Nama Ruangan -->
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Nama Ruangan
                    </h3>
                    <input type="text" value="{{ $aspiration->room->name ?? '-' }}" readonly
                        style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #374151;">
                </div>

                <!-- Judul Aspirasi/Pengaduan -->
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Judul Aspirasi/Pengaduan
                    </h3>
                    <input type="text" value="{{ $aspiration->title }}" readonly
                        style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #374151;">
                </div>

                <!-- Deskripsi -->
                <div style="margin-bottom: 1.75rem;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Deskripsi
                    </h3>
                    <textarea readonly rows="5"
                        style="width: 100%; padding: 0.625rem 0.875rem; border: 1px solid #d1d5db; border-radius: 6px; background: white; font-size: 0.875rem; color: #374151; resize: vertical;">{{ $aspiration->description }}</textarea>
                </div>

                <!-- Dokumentasi Pendukung -->
                <div style="margin-bottom: 2.5rem; position: relative;">
                    <h3 style="font-size: 0.9375rem; font-weight: 600; color: #000; margin-bottom: 0.75rem;">
                        Dokumentasi Pendukung
                    </h3>

                    @if($aspiration->documentation_file)
                        <div style="display: flex; flex-direction: column; gap: 0.625rem;">
                            <a href="{{ asset('storage/' . $aspiration->documentation_file) }}" target="_blank"
                                style="display: inline-flex; align-items: center; gap: 0.5rem; color: #3b82f6; text-decoration: none; font-size: 0.875rem;">
                                <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                    <polyline points="14 2 14 8 20 8" stroke="white" stroke-width="2" fill="none" />
                                </svg>
                                Lihat Dokumentasi Pendukung
                            </a>
                        </div>

                        <!-- Document Icon in bottom right -->
                        <div style="position: absolute; bottom: 0; right: 0;">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="1.5">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                <polyline points="14 2 14 8 20 8" />
                            </svg>
                        </div>
                    @else
                        <div
                            style="padding: 1.5rem; background: #f9fafb; border: 1px dashed #d1d5db; border-radius: 8px; text-align: center;">
                            <p style="color: #9ca3af; margin: 0; font-size: 0.875rem;">Tidak ada dokumen yang diupload</p>
                        </div>
                    @endif
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem;">
                    <a href="{{ route('admin.aspirations.index') }}"
                        style="color: #B8985F; text-decoration: underline; font-weight: 500; font-size: 0.9375rem;">
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
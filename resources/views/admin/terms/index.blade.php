@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan Peminjaman')

@section('content')
    <div class="container" style="max-width: 900px; margin: 0 auto; padding: 2rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <h1 style="font-size: 2rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.5rem;">Informasi</h1>

            {{-- Success Message --}}
            @if(session('success'))
                <div
                    style="background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Title Section --}}
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 1.5rem; font-weight: 700; color: #B8985F; margin-bottom: 0.5rem;">Syarat dan Ketentuan
                    Peminjaman</h2>
                <p style="color: #666; font-size: 0.95rem;">Pahami persyaratan dan ketentuan dalam peminjaman ruangan
                    Universitas Andalas</p>
            </div>

            {{-- Terms Content Card --}}
            <div
                style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border: 1px solid rgba(184, 152, 95, 0.3); border-radius: 12px; padding: 2rem; margin-bottom: 1.5rem;">
                {{-- Persyaratan Umum --}}
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 0.95rem; margin-bottom: 0.75rem;">Persyaratan
                        Umum</h3>
                    @if($persyaratanUmum->count() > 0)
                        <ul style="margin: 0; padding-left: 1.25rem; color: #374151; font-size: 0.9rem; line-height: 1.8;">
                            @foreach($persyaratanUmum as $term)
                                <li>{{ $term->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p style="color: #9ca3af; font-size: 0.875rem; font-style: italic;">Belum ada persyaratan umum</p>
                    @endif
                </div>

                {{-- Larangan --}}
                <div>
                    <h3 style="color: #B8985F; font-weight: 600; font-size: 0.95rem; margin-bottom: 0.75rem;">Larangan</h3>
                    @if($larangan->count() > 0)
                        <ul style="margin: 0; padding-left: 1.25rem; color: #374151; font-size: 0.9rem; line-height: 1.8;">
                            @foreach($larangan as $term)
                                <li>{{ $term->content }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p style="color: #9ca3af; font-size: 0.875rem; font-style: italic;">Belum ada larangan</p>
                    @endif
                </div>

                {{-- Action Buttons --}}
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem; margin-top: 1.5rem;">
                    <a href="{{ route('admin.terms.edit') }}"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: white; border: 1px solid #d1d5db; border-radius: 6px; color: #374151; text-decoration: none; font-size: 0.875rem; font-weight: 500;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                        Edit
                    </a>
                    <button onclick="document.getElementById('addTermModal').style.display='flex'"
                        style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Tambah Syarat
                    </button>
                </div>
            </div>

            {{-- Document Download Section --}}
            <div
                style="background: #E3F2FD; border-radius: 12px; padding: 1.5rem; display: flex; justify-content: space-between; align-items: center;">
                <span style="color: #1a1a1a; font-weight: 500;">Pahami syarat dan ketentuan</span>
                @if($document)
                    <a href="{{ asset('storage/' . $document->document_file) }}" target="_blank" download
                        style="padding: 0.5rem 1rem; background: #3b82f6; color: white; text-decoration: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500;">
                        Download Dokumen
                    </a>
                @else
                    <form action="{{ route('admin.terms.uploadDocument') }}" method="POST" enctype="multipart/form-data"
                        style="display: flex; gap: 0.5rem; align-items: center;">
                        @csrf
                        <input type="file" name="document_file" required accept=".pdf,.doc,.docx" style="font-size: 0.875rem;">
                        <button type="submit"
                            style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500; cursor: pointer;">
                            Upload
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Add Term Modal --}}
    <div id="addTermModal"
        style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div
            style="background: white; border-radius: 12px; padding: 2rem; max-width: 500px; width: 90%; box-shadow: 0 4px 20px rgba(0,0,0,0.15);">
            <h3 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: #1a1a1a;">Tambah Persyaratan
            </h3>
            <form action="{{ route('admin.terms.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1rem;">
                    <label
                        style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem; font-weight: 500;">Kategori</label>
                    <select name="category" required
                        style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px;">
                        <option value="persyaratan_umum">Persyaratan Umum</option>
                        <option value="larangan">Larangan</option>
                    </select>
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label
                        style="display: block; font-size: 0.875rem; color: #374151; margin-bottom: 0.5rem; font-weight: 500;">Isi
                        Persyaratan</label>
                    <textarea name="content" required rows="3" placeholder="Masukkan isi persyaratan..."
                        style="width: 100%; padding: 0.75rem; border: 1px solid #e5e7eb; border-radius: 8px; resize: vertical;"></textarea>
                </div>
                <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                    <button type="button" onclick="document.getElementById('addTermModal').style.display='none'"
                        style="padding: 0.75rem 1.5rem; background: white; color: #B8985F; border: 1px solid #B8985F; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Batal
                    </button>
                    <button type="submit"
                        style="padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
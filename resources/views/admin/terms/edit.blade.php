@extends('layouts.app')

@section('title', 'Edit Syarat dan Ketentuan')

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
            <div
                style="text-align: center; margin-bottom: 2rem; display: flex; justify-content: center; align-items: center; gap: 1rem;">
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #B8985F; margin-bottom: 0.5rem;">Syarat dan
                        Ketentuan Peminjaman</h2>
                    <p style="color: #666; font-size: 0.95rem;">Pahami persyaratan dan ketentuan dalam peminjaman ruangan
                        Universitas Andalas</p>
                </div>
                <span
                    style="padding: 0.5rem 1rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 20px; font-size: 0.875rem; font-weight: 500;">Editing</span>
            </div>

            {{-- Persyaratan Umum --}}
            <div
                style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border: 1px solid rgba(184, 152, 95, 0.3); border-radius: 12px; padding: 1.5rem; margin-bottom: 1.5rem;">
                <h3 style="color: #B8985F; font-weight: 600; font-size: 0.95rem; margin-bottom: 1rem;">Persyaratan Umum</h3>

                @foreach($persyaratanUmum as $term)
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; background: white; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 0.5rem;">
                        <span style="color: #374151; font-size: 0.9rem;">• {{ $term->content }}</span>
                        <button onclick="deleteTerm({{ $term->id }})"
                            style="background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0.25rem;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                @endforeach

                {{-- Add new term input --}}
                <form action="{{ route('admin.terms.store') }}" method="POST" style="margin-top: 0.5rem;">
                    @csrf
                    <input type="hidden" name="category" value="persyaratan_umum">
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="content" placeholder="Tambah persyaratan..." required
                            style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem;">
                        <button type="submit"
                            style="padding: 0.75rem; background: white; border: 1px solid #B8985F; border-radius: 8px; color: #B8985F; cursor: pointer;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Larangan --}}
            <div
                style="background: linear-gradient(135deg, rgba(184, 152, 95, 0.1), rgba(184, 152, 95, 0.05)); border: 1px solid rgba(184, 152, 95, 0.3); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                <h3 style="color: #B8985F; font-weight: 600; font-size: 0.95rem; margin-bottom: 1rem;">Larangan</h3>

                @foreach($larangan as $term)
                    <div
                        style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem 1rem; background: white; border: 1px solid #e5e7eb; border-radius: 8px; margin-bottom: 0.5rem;">
                        <span style="color: #374151; font-size: 0.9rem;">• {{ $term->content }}</span>
                        <button onclick="deleteTerm({{ $term->id }})"
                            style="background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0.25rem;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                                </path>
                            </svg>
                        </button>
                    </div>
                @endforeach

                {{-- Add new larangan input --}}
                <form action="{{ route('admin.terms.store') }}" method="POST" style="margin-top: 0.5rem;">
                    @csrf
                    <input type="hidden" name="category" value="larangan">
                    <div style="display: flex; gap: 0.5rem;">
                        <input type="text" name="content" placeholder="Tambah larangan..." required
                            style="flex: 1; padding: 0.75rem 1rem; border: 1px solid #e5e7eb; border-radius: 8px; font-size: 0.9rem;">
                        <button type="submit"
                            style="padding: 0.75rem; background: white; border: 1px solid #B8985F; border-radius: 8px; color: #B8985F; cursor: pointer;">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Document Upload --}}
            <div style="background: #f3f4f6; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                <h3 style="color: #374151; font-weight: 600; font-size: 0.95rem; margin-bottom: 1rem;">Dokumen Persyaratan
                </h3>
                <form action="{{ route('admin.terms.uploadDocument') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="display: flex; gap: 1rem; align-items: center;">
                        @if($document)
                            <div style="flex: 1; display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="20" height="20" fill="#3b82f6" viewBox="0 0 24 24">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6z" />
                                </svg>
                                <span style="color: #374151; font-size: 0.875rem;">Dokumen tersedia</span>
                                <a href="{{ asset('storage/' . $document->document_file) }}" target="_blank"
                                    style="color: #3b82f6; font-size: 0.875rem;">(Lihat)</a>
                            </div>
                        @endif
                        <input type="file" name="document_file" accept=".pdf,.doc,.docx" {{ $document ? '' : 'required' }}
                            style="font-size: 0.875rem;">
                        <button type="submit"
                            style="padding: 0.5rem 1rem; background: #3b82f6; color: white; border: none; border-radius: 6px; font-size: 0.875rem; cursor: pointer;">
                            {{ $document ? 'Ganti' : 'Upload' }}
                        </button>
                    </div>
                </form>
            </div>

            {{-- Action Buttons --}}
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('admin.terms.index') }}"
                    style="padding: 0.75rem 2rem; background: white; color: #6b7280; border: 1px solid #d1d5db; border-radius: 8px; text-decoration: none; font-weight: 500;">
                    Batalkan
                </a>
                <a href="{{ route('admin.terms.index') }}"
                    style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border-radius: 8px; text-decoration: none; font-weight: 600;">
                    Simpan
                </a>
            </div>
        </div>
    </div>

    <script>
        async function deleteTerm(id) {
            const confirmed = await confirmDelete('syarat ini');
            if (confirmed) {
                fetch(`{{ url('admin/terms') }}/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        }
                    });
            }
        }
    </script>
@endsection
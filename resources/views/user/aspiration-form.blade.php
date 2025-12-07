@extends('layouts.user')

@section('title', 'Form Aspirasi & Pengaduan')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 900px;">
        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <!-- Header -->
            <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 2rem; color: #1a1a1a;">
                Form Aspirasi dan Pengaduan
            </h1>

            <form action="{{ route('user.aspirations.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Display Validation Errors --}}
                @if ($errors->any())
                    <div
                        style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                        <strong>Error:</strong>
                        <ul style="margin: 0.5rem 0 0 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Nama Pengirim (Auto-filled) -->
                <div style="margin-bottom: 2rem;">
                    <label
                        style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a; font-size: 1rem;">
                        Nama Pengirim
                    </label>
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; background: #F9FAFB; padding: 0.875rem 1rem; border-radius: 8px; border: 1px solid #E5E7EB;">
                        <span style="color: #1a1a1a; font-weight: 500;">{{ Auth::user()->name }}</span>
                        <span style="color: #6B7280; font-size: 0.875rem;">{{ Auth::user()->email }}</span>
                    </div>
                </div>

                <!-- Nama Ruangan -->
                <div style="margin-bottom: 2rem;">
                    <label
                        style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a; font-size: 1rem;">
                        Nama Ruangan
                    </label>
                    <select name="room_id"
                        style="width: 100%; padding: 0.875rem 1rem; border: 1px solid #E5E7EB; border-radius: 8px; background: white; cursor: pointer; font-size: 1rem; color: #6B7280;">
                        <option value="">Pilih Ruangan</option>
                        @foreach(\App\Models\Room::all() as $room)
                            <option value="{{ $room->id }}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Judul Aspirasi/Pengaduan -->
                <div style="margin-bottom: 2rem;">
                    <label
                        style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a; font-size: 1rem;">
                        Judul Aspirasi/Pengaduan
                    </label>
                    <input type="text" name="title" placeholder="Masukkan aspirasi atau pengaduan" required
                        style="width: 100%; padding: 0.875rem 1rem; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 1rem; background: white;">
                </div>

                <!-- Deskripsi -->
                <div style="margin-bottom: 2rem;">
                    <label
                        style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a; font-size: 1rem;">
                        Deskripsi
                    </label>
                    <textarea name="description" placeholder="Masukkan deskripsi aspirasi/pengaduan" required rows="5"
                        style="width: 100%; padding: 0.875rem 1rem; border: 1px solid #E5E7EB; border-radius: 8px; font-size: 1rem; background: white; resize: vertical;"></textarea>
                </div>

                <!-- Dokumentasi Pendukung -->
                <div style="margin-bottom: 3rem;">
                    <label
                        style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1a1a1a; font-size: 1rem;">
                        Dokumentasi Pendukung
                    </label>
                    <div onclick="document.getElementById('documentationFile').click()"
                        style="border: 2px dashed #E5E7EB; border-radius: 12px; padding: 3rem 1rem; text-align: center; cursor: pointer; background: #F9FAFB; transition: all 0.3s; display: flex; flex-direction: column; align-items: center; justify-content: center;"
                        onmouseover="this.style.borderColor='#B8985F'; this.style.background='#fcfcfc'"
                        onmouseout="this.style.borderColor='#E5E7EB'; this.style.background='#F9FAFB'">
                        <svg width="48" height="48" fill="none" stroke="#9CA3AF" viewBox="0 0 24 24"
                            style="margin-bottom: 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <div id="uploadText" style="font-size: 0.95rem; color: #1a1a1a; font-weight: 500;">
                            Klik atau drag and drop untuk upload
                        </div>
                        <div style="font-size: 0.875rem; color: #9CA3AF; margin-top: 0.5rem;">
                            PNG, JPG, JPEG
                        </div>
                        <input type="file" id="documentationFile" name="documentation_file" accept=".pdf,.png,.jpg,.jpeg"
                            style="display: none;">
                    </div>
                </div>

                <!-- Buttons -->
                <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                    <a href="{{ route('user.profile') }}"
                        style="flex: 1; padding: 1rem; border: 2px solid #E5E7EB; background: white; color: #6B7280; border-radius: 8px; text-decoration: none; font-weight: 600; text-align: center; transition: all 0.3s;">
                        Batalkan
                    </a>
                    <button type="submit"
                        style="flex: 1; padding: 1rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-size: 1rem;">
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show filename when file selected
        document.getElementById('documentationFile').addEventListener('change', function (e) {
            if (this.files.length > 0) {
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // MB

                document.getElementById('uploadText').innerHTML =
                    `<strong style="color: #10b981;">✓ ${fileName}</strong> (${fileSize} MB)`;
            }
        });
    </script>
@endsection
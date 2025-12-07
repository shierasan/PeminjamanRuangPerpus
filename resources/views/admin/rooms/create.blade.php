@extends('layouts.app')

@section('title', 'Tambah Ruangan - Admin')

@section('content')
    <div class="container" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 2rem;">Form Tambah Ruangan</h1>

            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return confirm('Apakah Anda yakin ingin menambah ruangan ini?');">
                @csrf

                {{-- Nama Ruangan --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Nama
                        Ruangan</label>
                    <input type="text" name="name" placeholder="Masukkan nama ruangan" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>

                {{-- Deskripsi --}}
                <div style="margin-bottom: 1.5rem;">
                    <label
                        style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Deskripsi</label>
                    <textarea name="description" rows="3" placeholder="Masukkan deskripsi ruangan"
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; font-family: inherit; resize: vertical;"></textarea>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    {{-- Lantai --}}
                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Lantai</label>
                        <input type="number" name="floor" value="1" min="1" max="10" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    </div>

                    {{-- Kapasitas --}}
                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Kapasitas</label>
                        <input type="number" name="capacity" value="0" min="0" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    </div>

                    {{-- Fasilitas --}}
                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Fasilitas</label>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="checkbox" name="facilities[]" value="Wi-Fi"
                                    style="width: 18px; height: 18px; cursor: pointer;">
                                <span>Wi-Fi</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="checkbox" name="facilities[]" value="Proyektor"
                                    style="width: 18px; height: 18px; cursor: pointer;">
                                <span>Proyektor</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="checkbox" name="facilities[]" value="AC"
                                    style="width: 18px; height: 18px; cursor: pointer;">
                                <span>AC</span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="checkbox" name="facilities[]" value="Printer"
                                    style="width: 18px; height: 18px; cursor: pointer;">
                                <span>Printer</span>
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Kontak --}}
                <div style="margin-bottom: 1.5rem;">
                    <h3 style="font-weight: 600; margin-bottom: 1rem; color: #1a1a1a;">Kontak</h3>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label
                                style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.875rem;">Nama
                                Kontak</label>
                            <input type="text" name="contact_name" placeholder="Masukkan nama kontak yang dapat dihubungi"
                                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                        </div>
                        <div style="position: relative;">
                            <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.875rem;">No.
                                Telepon</label>
                            <div style="position: relative;">
                                <input type="text" name="contact_phone"
                                    placeholder="Masukkan nomor telepon dalam bentuk angka"
                                    style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                                <div
                                    style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); width: 32px; height: 32px; background: linear-gradient(135deg, #B8985F, #9d7d4b); border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                    <svg width="18" height="18" fill="none" stroke="white" stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Dokumentasi Ruangan --}}
                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Dokumentasi
                        Ruangan</label>
                    <div onclick="document.getElementById('imageUpload').click()"
                        style="border: 2px dashed #ddd; border-radius: 12px; padding: 3rem 2rem; text-align: center; cursor: pointer; background: #fafafa; transition: all 0.3s;"
                        onmouseover="this.style.borderColor='#B8985F'; this.style.background='#fcfcfc'"
                        onmouseout="this.style.borderColor='#ddd'; this.style.background='#fafafa'">
                        <svg width="48" height="48" fill="none" stroke="#999" viewBox="0 0 24 24"
                            style="margin: 0 auto 1rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                            </path>
                        </svg>
                        <div style="font-weight: 500; color: #666; margin-bottom: 0.25rem;">Klik atau drag and drop untuk
                            upload</div>
                        <div style="font-size: 0.875rem; color: #999;">PNG, JPG, JPEG</div>
                        <input type="file" id="imageUpload" name="image" accept=".png,.jpg,.jpeg" style="display: none;">
                    </div>
                </div>

                {{-- Buttons --}}
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
                    <a href="{{ route('admin.rooms.index') }}"
                        style="padding: 0.75rem 2rem; border: 2px solid #ddd; background: white; color: #666; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                        Batalkan
                    </a>
                    <button type="submit"
                        style="padding: 0.75rem 2.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                        Tambah Ruangan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
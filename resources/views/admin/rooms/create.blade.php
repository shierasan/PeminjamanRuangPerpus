@extends('layouts.app')

@section('title', 'Tambah Ruangan - Admin')

@section('content')
    <div class="container" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 2rem;">Form Tambah Ruangan</h1>

            {{-- Error Display --}}
            @if ($errors->any())
                <div
                    style="background: #fef2f2; border: 1px solid #ef4444; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
                    <ul style="margin: 0; padding-left: 1.25rem; color: #dc2626;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.rooms.store') }}" method="POST" enctype="multipart/form-data">
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

                {{-- Dokumentasi Ruangan (3 Separate Inputs) --}}
                <div style="margin-bottom: 2rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Foto Ruangan
                        (Maksimal 3 foto)</label>
                    <p style="font-size: 0.875rem; color: #666; margin-bottom: 1rem;">Foto pertama akan menjadi foto profil
                        ruangan.</p>

                    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                        {{-- Photo 1 (Profile) --}}
                        <div style="width: 140px;">
                            <div id="preview1"
                                style="display: none; position: relative; width: 140px; height: 140px; border-radius: 8px; overflow: hidden; border: 2px solid #B8985F; margin-bottom: 0.5rem;">
                                <img id="img1" src="" style="width: 100%; height: 100%; object-fit: cover;">
                                <span
                                    style="position: absolute; top: 4px; left: 4px; background: #B8985F; color: white; font-size: 10px; padding: 2px 6px; border-radius: 4px;">Profil</span>
                                <button type="button" onclick="clearImage(1)"
                                    style="position: absolute; top: 4px; right: 4px; width: 20px; height: 20px; background: rgba(239,68,68,0.9); border: none; border-radius: 50%; color: white; cursor: pointer; font-size: 12px;">×</button>
                            </div>
                            <div id="upload1" onclick="document.getElementById('image1').click()"
                                style="width: 140px; height: 140px; border: 2px dashed #B8985F; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; background: #fffbf0;">
                                <svg width="24" height="24" fill="none" stroke="#B8985F" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <div style="font-size: 0.75rem; color: #B8985F; margin-top: 0.5rem; font-weight: 600;">Foto
                                    Profil</div>
                            </div>
                            <input type="file" id="image1" name="images[]" accept=".png,.jpg,.jpeg" style="display: none;"
                                onchange="previewSingle(this, 1)">
                        </div>

                        {{-- Photo 2 --}}
                        <div style="width: 140px;">
                            <div id="preview2"
                                style="display: none; position: relative; width: 140px; height: 140px; border-radius: 8px; overflow: hidden; border: 2px solid #ddd; margin-bottom: 0.5rem;">
                                <img id="img2" src="" style="width: 100%; height: 100%; object-fit: cover;">
                                <button type="button" onclick="clearImage(2)"
                                    style="position: absolute; top: 4px; right: 4px; width: 20px; height: 20px; background: rgba(239,68,68,0.9); border: none; border-radius: 50%; color: white; cursor: pointer; font-size: 12px;">×</button>
                            </div>
                            <div id="upload2" onclick="document.getElementById('image2').click()"
                                style="width: 140px; height: 140px; border: 2px dashed #ddd; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; background: #fafafa;">
                                <svg width="24" height="24" fill="none" stroke="#999" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <div style="font-size: 0.75rem; color: #999; margin-top: 0.5rem;">Foto 2</div>
                            </div>
                            <input type="file" id="image2" name="images[]" accept=".png,.jpg,.jpeg" style="display: none;"
                                onchange="previewSingle(this, 2)">
                        </div>

                        {{-- Photo 3 --}}
                        <div style="width: 140px;">
                            <div id="preview3"
                                style="display: none; position: relative; width: 140px; height: 140px; border-radius: 8px; overflow: hidden; border: 2px solid #ddd; margin-bottom: 0.5rem;">
                                <img id="img3" src="" style="width: 100%; height: 100%; object-fit: cover;">
                                <button type="button" onclick="clearImage(3)"
                                    style="position: absolute; top: 4px; right: 4px; width: 20px; height: 20px; background: rgba(239,68,68,0.9); border: none; border-radius: 50%; color: white; cursor: pointer; font-size: 12px;">×</button>
                            </div>
                            <div id="upload3" onclick="document.getElementById('image3').click()"
                                style="width: 140px; height: 140px; border: 2px dashed #ddd; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; background: #fafafa;">
                                <svg width="24" height="24" fill="none" stroke="#999" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                <div style="font-size: 0.75rem; color: #999; margin-top: 0.5rem;">Foto 3</div>
                            </div>
                            <input type="file" id="image3" name="images[]" accept=".png,.jpg,.jpeg" style="display: none;"
                                onchange="previewSingle(this, 3)">
                        </div>
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

    <script>
        function previewSingle(input, num) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    document.getElementById('img' + num).src = e.target.result;
                    document.getElementById('preview' + num).style.display = 'block';
                    document.getElementById('upload' + num).style.display = 'none';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
        function clearImage(num) {
            document.getElementById('image' + num).value = '';
            document.getElementById('preview' + num).style.display = 'none';
            document.getElementById('upload' + num).style.display = 'flex';
        }
    </script>
@endsection
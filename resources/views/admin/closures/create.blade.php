@extends('layouts.app')

@section('title', 'Tambah Penutupan Ruangan - Admin')

@section('content')
    <div class="container" style="max-width: 700px; margin: 0 auto; padding: 1.5rem 1rem;">
        <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
            {{-- Header --}}
            <div style="margin-bottom: 2rem;">
                <a href="{{ route('admin.closures.index') }}"
                    style="color: #666; text-decoration: none; font-size: 0.9rem; display: inline-flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
                <h1 style="font-size: 1.75rem; font-weight: 700; color: #1a1a1a;">
                    Tambah Penutupan Ruangan
                </h1>
            </div>

            {{-- Error Messages --}}
            @if($errors->any())
                <div
                    style="background: #fee2e2; border: 1px solid #fecaca; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.closures.store') }}" method="POST">
                @csrf

                {{-- Room Selection --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">
                        Ruangan <span style="color: #ef4444;">*</span>
                    </label>
                    <select name="room_id" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; background: white;">
                        <option value="all">🔒 Semua Ruangan (Libur/Event Khusus)</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Date --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">
                        Tanggal Penutupan <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="date" name="closure_date" value="{{ old('closure_date') }}" required
                        min="{{ date('Y-m-d') }}"
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>

                {{-- Closure Type Selection --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.75rem; color: #1a1a1a;">
                        Jenis Penutupan <span style="color: #ef4444;">*</span>
                    </label>
                    <div style="display: flex; gap: 1rem;">
                        <label
                            style="flex: 1; display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 2px solid #ddd; border-radius: 8px; cursor: pointer; transition: all 0.2s;"
                            onclick="this.style.borderColor='#B8985F'; document.querySelector('[value=specific]').parentElement.style.borderColor='#ddd';">
                            <input type="radio" name="closure_type" value="whole_day" checked
                                onclick="toggleTimeInputs(false)" style="width: 20px; height: 20px; accent-color: #B8985F;">
                            <div>
                                <div style="font-weight: 600; color: #1a1a1a;">Seharian</div>
                                <div style="font-size: 0.75rem; color: #666;">Tutup dari pagi sampai malam</div>
                            </div>
                        </label>
                        <label
                            style="flex: 1; display: flex; align-items: center; gap: 0.75rem; padding: 1rem; border: 2px solid #ddd; border-radius: 8px; cursor: pointer; transition: all 0.2s;"
                            onclick="this.style.borderColor='#B8985F'; document.querySelector('[value=whole_day]').parentElement.style.borderColor='#ddd';">
                            <input type="radio" name="closure_type" value="specific" onclick="toggleTimeInputs(true)"
                                style="width: 20px; height: 20px; accent-color: #B8985F;">
                            <div>
                                <div style="font-weight: 600; color: #1a1a1a;">Beberapa Jam</div>
                                <div style="font-size: 0.75rem; color: #666;">Pilih rentang waktu tertentu</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Time Range (Hidden by default) --}}
                <div id="timeInputs"
                    style="background: #f9fafb; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; display: none;">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div>
                            <label style="display: block; font-size: 0.875rem; color: #666; margin-bottom: 0.25rem;">Jam
                                Mulai <span style="color: #ef4444;">*</span></label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}"
                                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                        </div>
                        <div>
                            <label style="display: block; font-size: 0.875rem; color: #666; margin-bottom: 0.25rem;">Jam
                                Selesai <span style="color: #ef4444;">*</span></label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}"
                                style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                        </div>
                    </div>
                </div>

                {{-- Reason --}}
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">
                        Alasan Penutupan <span style="color: #ef4444;">*</span>
                    </label>
                    <input type="text" name="reason" value="{{ old('reason') }}" required
                        placeholder="Contoh: Maintenance AC, Libur Nasional, Event Internal"
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>

                {{-- Send Announcement Checkbox --}}
                <div
                    style="background: #FFF9E6; padding: 1rem 1.5rem; border-radius: 8px; margin-bottom: 2rem; border: 1px solid #E6D5A8;">
                    <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer;">
                        <input type="checkbox" name="send_announcement" value="1" checked
                            style="width: 20px; height: 20px; accent-color: #B8985F;">
                        <div>
                            <div style="font-weight: 600; color: #1a1a1a;">Kirim Pengumuman ke Semua User</div>
                            <div style="font-size: 0.75rem; color: #666;">Pengumuman akan otomatis dibuat untuk memberitahu
                                semua user tentang penutupan ini</div>
                        </div>
                    </label>
                </div>

                {{-- Buttons --}}
                <div style="display: flex; justify-content: flex-end; gap: 1rem;">
                    <a href="{{ route('admin.closures.index') }}"
                        style="padding: 0.75rem 2rem; border: 1px solid #ddd; background: white; color: #666; border-radius: 8px; text-decoration: none; font-weight: 500;">
                        Batal
                    </a>
                    <button type="submit"
                        style="padding: 0.75rem 2rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer;">
                        Simpan Penutupan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleTimeInputs(show) {
            const timeInputs = document.getElementById('timeInputs');
            const startTime = document.getElementById('start_time');
            const endTime = document.getElementById('end_time');

            if (show) {
                timeInputs.style.display = 'block';
                startTime.required = true;
                endTime.required = true;
            } else {
                timeInputs.style.display = 'none';
                startTime.required = false;
                endTime.required = false;
                startTime.value = '';
                endTime.value = '';
            }
        }
    </script>
@endsection
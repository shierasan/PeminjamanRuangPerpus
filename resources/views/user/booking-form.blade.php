@extends('layouts.user')

@section('title', 'Form Peminjaman')

@section('content')
    <div class="container" style="padding: 3rem 0; max-width: 800px;">

        <div style="background: white; border-radius: 16px; padding: 3rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">

            <!-- Header -->
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <h1 style="font-size: 1.75rem; font-weight: 700; margin: 0; color: #1a1a1a;">
                    Form Pengajuan Peminjaman
                </h1>
                <div style="background: #FFF9E6; padding: 0.75rem 1.5rem; border-radius: 8px; border: 1px solid #E6D5A8;">
                    <span style="color: #B8985F; font-weight: 600; font-size: 0.95rem;">{{ $room->name }}</span>
                </div>
            </div>

            <form action="{{ route('user.bookings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="room_id" value="{{ $room->id }}">

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

                {{-- Display Session Error (time conflict, weekend) --}}
                @if(session('error'))
                    <div
                        style="background: #fee2e2; border: 1px solid #fca5a5; color: #dc2626; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
                        <strong>Error:</strong> {{ session('error') }}
                    </div>
                @endif

                <!-- Tanggal yang dipilih -->
                <div style="margin-bottom: 2rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">Tanggal yang dipilih</h3>
                    <div style="display: grid; grid-template-columns: 1fr auto; gap: 1rem;">
                        <input type="date" name="booking_date" value="{{ $selectedDate ?? date('Y-m-d') }}" required
                            style="padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">

                        <select name="start_time" required
                            style="padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer;">
                            <option value="">Pilih Waktu</option>
                            <option value="08:00">08:00</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>

                    <div style="margin-top: 1rem;">
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #666; font-size: 0.875rem;">Waktu
                            Selesai</label>
                        <select name="end_time" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; background: white; cursor: pointer;">
                            <option value="">Pilih Waktu Selesai</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="12:00">12:00</option>
                            <option value="13:00">13:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                            <option value="17:00">17:00</option>
                        </select>
                    </div>

                    {{-- Info message about max duration --}}
                    <div
                        style="background: #FEF3C7; border: 1px solid #FCD34D; border-radius: 8px; padding: 0.75rem 1rem; margin-top: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                        <svg width="20" height="20" fill="#D97706" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span style="color: #92400E; font-size: 0.875rem; font-weight: 500;">
                            Durasi peminjaman maksimal <strong>2 jam</strong>. Kunci ruangan harus dikembalikan setelah
                            waktu selesai.
                        </span>
                    </div>
                </div>

                <!-- Informasi Kegiatan -->
                <div style="margin-bottom: 2rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">Informasi Kegiatan</h3>

                    <div style="margin-bottom: 1rem;">
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #666; font-size: 0.875rem;">
                            Nama Kegiatan
                        </label>
                        <input type="text" name="event_name" placeholder="Masukkan nama kegiatan" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #666; font-size: 0.875rem;">
                            Penyelenggara
                        </label>
                        <input type="text" name="organizer" placeholder="Masukkan nama penyelenggara" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                    </div>

                    <div>
                        <label
                            style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #666; font-size: 0.875rem;">
                            Jumlah Peserta
                        </label>
                        <input type="number" name="participants_count" placeholder="Masukkan jumlah peserta" min="1"
                            max="{{ $room->capacity }}" required
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                        <div style="font-size: 0.75rem; color: #999; margin-top: 0.25rem;">
                            Maksimal {{ $room->capacity }} orang
                        </div>
                    </div>
                </div>

                <!-- Dokumentasi Pendukung -->
                <div style="margin-bottom: 2rem;">
                    <h3 style="font-weight: 700; margin-bottom: 1rem; color: #1a1a1a;">Dokumentasi Pendukung</h3>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                        <!-- Surat pengajuan -->
                        <div>
                            <label
                                style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #666; font-size: 0.875rem;">
                                Surat pengajuan
                            </label>
                            <div onclick="document.getElementById('letterFile').click()"
                                style="border: 2px dashed #ddd; border-radius: 12px; padding: 2rem 1rem; text-align: center; cursor: pointer; background: #fafafa; transition: all 0.3s; min-height: 150px; display: flex; flex-direction: column; align-items: center; justify-content: center;"
                                onmouseover="this.style.borderColor='#B8985F'; this.style.background='#fcfcfc'"
                                onmouseout="this.style.borderColor='#ddd'; this.style.background='#fafafa'">
                                <svg width="40" height="40" fill="none" stroke="#999" viewBox="0 0 24 24"
                                    style="margin-bottom: 0.75rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <div style="font-size: 0.875rem; color: #666; font-weight: 500;">Klik atau drag and drop
                                    untuk upload</div>
                                <div style="font-size: 0.75rem; color: #999; margin-top: 0.25rem;">PDF, PNG, JPEG (Maks.
                                    2MB)
                                </div>
                                <input type="file" id="letterFile" name="letter_file"
                                    accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" style="display: none;">
                            </div>
                        </div>

                        <!-- Rundown Acara -->
                        <div>
                            <label
                                style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #666; font-size: 0.875rem;">
                                Rundown Acara
                            </label>
                            <div onclick="document.getElementById('rundownFile').click()"
                                style="border: 2px dashed #ddd; border-radius: 12px; padding: 2rem 1rem; text-align: center; cursor: pointer; background: #fafafa; transition: all 0.3s; min-height: 150px; display: flex; flex-direction: column; align-items: center; justify-content: center;"
                                onmouseover="this.style.borderColor='#B8985F'; this.style.background='#fcfcfc'"
                                onmouseout="this.style.borderColor='#ddd'; this.style.background='#fafafa'">
                                <svg width="40" height="40" fill="none" stroke="#999" viewBox="0 0 24 24"
                                    style="margin-bottom: 0.75rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                    </path>
                                </svg>
                                <div style="font-size: 0.875rem; color: #666; font-weight: 500;">Klik atau drag and drop
                                    untuk upload</div>
                                <div style="font-size: 0.75rem; color: #999; margin-top: 0.25rem;">PDF, PNG, JPEG (Maks.
                                    2MB)
                                </div>
                                <input type="file" id="rundownFile" name="rundown_file"
                                    accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" style="display: none;">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 3rem;">
                    <a href="{{ route('user.rooms.detail', $room->id) }}"
                        style="padding: 0.75rem 2rem; border: 2px solid #ddd; background: white; color: #666; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                        Batalkan
                    </a>
                    <button type="submit"
                        style="padding: 0.75rem 2.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s; font-size: 1rem;">
                        Ajukan Peminjaman
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show filename when file selected - WITHOUT destroying the input
        document.getElementById('letterFile').addEventListener('change', function (e) {
            if (this.files.length > 0) {
                const parent = this.closest('div[onclick]');
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // MB

                // Update the display text, but keep the input
                parent.querySelector('div[style*="font-size: 0.875rem"]').innerHTML =
                    `<strong style="color: #10b981;">✓ ${fileName}</strong> (${fileSize} MB)`;
            }
        });

        document.getElementById('rundownFile').addEventListener('change', function (e) {
            if (this.files.length > 0) {
                const parent = this.closest('div[onclick]');
                const fileName = this.files[0].name;
                const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2); // MB

                // Update the display text, but keep the input
                parent.querySelector('div[style*="font-size: 0.875rem"]').innerHTML =
                    `<strong style="color: #10b981;">✓ ${fileName}</strong> (${fileSize} MB)`;
            }
        });

        // 2-hour max duration validation
        const startTimeSelect = document.querySelector('select[name="start_time"]');
        const endTimeSelect = document.querySelector('select[name="end_time"]');

        startTimeSelect.addEventListener('change', function () {
            updateEndTimeOptions();
        });

        endTimeSelect.addEventListener('change', function () {
            validateDuration();
        });

        function updateEndTimeOptions() {
            const startTime = startTimeSelect.value;
            if (!startTime) return;

            const startHour = parseInt(startTime.split(':')[0]);
            const maxEndHour = Math.min(startHour + 2, 17); // Max 2 hours, but not past 17:00

            // Update end time options
            Array.from(endTimeSelect.options).forEach(option => {
                if (option.value === '') return;
                const endHour = parseInt(option.value.split(':')[0]);

                if (endHour <= startHour || endHour > maxEndHour) {
                    option.disabled = true;
                    option.style.color = '#ccc';
                } else {
                    option.disabled = false;
                    option.style.color = '';
                }
            });

            // Auto-select max end time (2 hours after start)
            const autoEndTime = (startHour + 2).toString().padStart(2, '0') + ':00';
            if (endTimeSelect.querySelector(`option[value="${autoEndTime}"]`)) {
                endTimeSelect.value = autoEndTime;
            }
        }

        function validateDuration() {
            const startTime = startTimeSelect.value;
            const endTime = endTimeSelect.value;

            if (!startTime || !endTime) return;

            const startHour = parseInt(startTime.split(':')[0]);
            const endHour = parseInt(endTime.split(':')[0]);
            const duration = endHour - startHour;

            if (duration > 2) {
                alert('Durasi peminjaman maksimal 2 jam!');
                endTimeSelect.value = '';
            }
        }
    </script>
@endsection
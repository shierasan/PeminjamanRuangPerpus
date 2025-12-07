@extends('layouts.app')

@section('title', 'Edit Ruangan - Admin')

@section('content')
<div class="container" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
    <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 2rem;">Form Edit Ruangan</h1>

        <form action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data"
            onsubmit="return confirm('Apakah Anda yakin ingin menyimpan perubahan ini?');">
            @csrf
            @method('PUT')

            {{-- Nama Ruangan --}}
            <div style="margin-bottom: 1.5rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Nama
                    Ruangan</label>
                <input type="text" name="name" value="{{ old('name', $room->name) }}" placeholder="Masukkan nama ruangan" required
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
            </div>

            {{-- Deskripsi --}}
            <div style="margin-bottom: 1.5rem;">
                <label
                    style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Deskripsi</label>
                <textarea name="description" rows="3" placeholder="Masukkan deskripsi ruangan"
                    style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem; font-family: inherit; resize: vertical;">{{ old('description', $room->description) }}</textarea>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                {{-- Lantai --}}
                <div>
                    <label
                        style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Lantai</label>
                    <input type="number" name="floor" value="{{ old('floor', $room->floor ?? 1) }}" min="1" max="10" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>

                {{-- Kapasitas --}}
                <div>
                    <label
                        style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Kapasitas</label>
                    <input type="number" name="capacity" value="{{ old('capacity', $room->capacity) }}" min="0" required
                        style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 1rem;">
                </div>

                {{-- Fasilitas --}}
                <div>
                    <label
                        style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Fasilitas</label>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @php
                            $currentFacilities = old('facilities', $room->facilities ?? []);
                        @endphp
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="facilities[]" value="Wi-Fi" 
                                {{ in_array('Wi-Fi', $currentFacilities) ? 'checked' : '' }}
                                style="width: 18px; height: 18px; cursor: pointer;">
                            <span>Wi-Fi</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="facilities[]" value="Proyektor"
                                {{ in_array('Proyektor', $currentFacilities) ? 'checked' : '' }}
                                style="width: 18px; height: 18px; cursor: pointer;">
                            <span>Proyektor</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="facilities[]" value="AC"
                                {{ in_array('AC', $currentFacilities) ? 'checked' : '' }}
                                style="width: 18px; height: 18px; cursor: pointer;">
                            <span>AC</span>
                        </label>
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input type="checkbox" name="facilities[]" value="Printer"
                                {{ in_array('Printer', $currentFacilities) ? 'checked' : '' }}
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
                        <input type="text" name="contact_name" value="{{ old('contact_name', $room->contact_name) }}"
                            placeholder="Masukkan nama kontak yang dapat dihubungi"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                    </div>
                    <div style="position: relative;">
                        <label style="display: block; font-weight: 500; margin-bottom: 0.5rem; font-size: 0.875rem;">No.
                            Telepon</label>
                        <input type="text" name="contact_phone" value="{{ old('contact_phone', $room->contact_phone) }}"
                            placeholder="Masukkan nomor telepon dalam bentuk angka"
                            style="width: 100%; padding: 0.75rem 1rem; border: 1px solid #ddd; border-radius: 8px; font-size: 0.95rem;">
                    </div>
                </div>
            </div>

            {{-- Dokumentasi Ruangan --}}
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Dokumentasi
                    Ruangan</label>
                
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                    {{-- Existing Image --}}
                    @if($room->image)
                        <div id="existingImage" style="position: relative; border-radius: 12px; overflow: hidden; aspect-ratio: 1;">
                            <img src="{{ asset('storage/' . $room->image) }}" alt="{{ $room->name }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                            <button type="button" onclick="deleteImage()"
                                style="position: absolute; top: 0.5rem; right: 0.5rem; width: 28px; height: 28px; background: rgba(239, 68, 68, 0.9); border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                                <svg width="14" height="14" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        <input type="hidden" id="deleteImageFlag" name="delete_image" value="0">
                    @endif

                    {{-- Upload New Image --}}
                    <div onclick="document.getElementById('imageUpload').click()"
                        style="border: 2px dashed #ddd; border-radius: 12px; padding: 2rem 1rem; text-align: center; cursor: pointer; background: #fafafa; transition: all 0.3s; aspect-ratio: 1; display: flex; flex-direction: column; align-items: center; justify-content: center;"
                        onmouseover="this.style.borderColor='#B8985F'; this.style.background='#fcfcfc'"
                        onmouseout="this.style.borderColor='#ddd'; this.style.background='#fafafa'">
                        <svg width="32" height="32" fill="none" stroke="#999" viewBox="0 0 24 24" style="margin-bottom: 0.5rem;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <div style="font-size: 0.75rem; color: #999;">Klik atau drag and drop untuk upload</div>
                        <div style="font-size: 0.65rem; color: #ccc; margin-top: 0.25rem;">PNG, JPG, JPEG</div>
                        <input type="file" id="imageUpload" name="image" accept=".png,.jpg,.jpeg" style="display: none;">
                    </div>
                </div>
            </div>

            {{-- Kalender Peminjaman --}}
            <div style="margin-bottom: 2rem; padding: 1.5rem; background: #FFF9E6; border-radius: 12px; border: 1px solid #E6D5A8;">
                <h3 style="font-weight: 700; margin-bottom: 1.5rem; color: #1a1a1a; text-align: center;">
                    Kalender Peminjaman - {{ $room->name }}
                </h3>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
                    <button type="button" onclick="previousMonth()"
                        style="background: none; border: none; cursor: pointer; padding: 0.5rem; font-size: 1.25rem;">
                        &lt;
                    </button>
                    <h4 id="calendarMonth" style="font-weight: 600; font-size: 1rem; margin: 0;"></h4>
                    <button type="button" onclick="nextMonth()"
                        style="background: none; border: none; cursor: pointer; padding: 0.5rem; font-size: 1.25rem;">
                        &gt;
                    </button>
                </div>

                <div id="calendarGrid" style="display: grid; grid-template-columns: repeat(7, 1fr); gap: 0.25rem; text-align: center;">
                </div>

                {{-- Legend --}}
                <div style="display: flex; justify-content: center; gap: 1.5rem; margin-top: 1.5rem; font-size: 0.75rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #10b981; border-radius: 4px;"></div>
                        <span>Tersedia</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #F59E0B; border-radius: 4px;"></div>
                        <span>Ada Booking</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <div style="width: 16px; height: 16px; background: #EF4444; border-radius: 4px;"></div>
                        <span>Libur/Penuh</span>
                    </div>
                </div>
            </div>

            {{-- Buttons --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('admin.rooms.index') }}"
                        style="padding: 0.75rem 2rem; border: 2px solid #ddd; background: white; color: #666; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;">
                        Batalkan
                    </a>
                    
                    <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" 
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus ruangan ini? Data tidak dapat dikembalikan.');" 
                        style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            style="padding: 0.75rem 2rem; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                            onmouseover="this.style.background='#dc2626'"
                            onmouseout="this.style.background='#ef4444'">
                            Hapus Ruangan
                        </button>
                    </form>
                </div>
                
                <button type="submit"
                    style="padding: 0.75rem 2.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function deleteImage() {
    if (confirm('Hapus gambar ini?')) {
        document.getElementById('existingImage').style.display = 'none';
        document.getElementById('deleteImageFlag').value = '1';
    }
}

// Calendar implementation
let currentDate = new Date();
const bookings = @json($bookings);
const today = new Date();
today.setHours(0, 0, 0, 0);

function isSunday(year, month, day) {
    const date = new Date(year, month, day);
    return date.getDay() === 0;
}

function isPastDate(year, month, day) {
    const date = new Date(year, month, day);
    return date < today;
}

function hasAnyBooking(dateStr) {
    return bookings.some(b => b.booking_date === dateStr);
}

function getBookingsForDate(dateStr) {
    return bookings.filter(b => b.booking_date === dateStr && b.status === 'approved');
}

function isFullyBooked(dateStr) {
    return getBookingsForDate(dateStr).length >= 3;
}

function renderCalendar() {
    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    document.getElementById('calendarMonth').textContent = monthNames[month] + ' ' + year;

    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    let calendarHTML = '';

    // Day headers
    const dayHeaders = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    dayHeaders.forEach((day, index) => {
        const color = index === 6 ? '#EF4444' : '#666';
        calendarHTML += `<div style="font-weight: 600; font-size: 0.75rem; color: ${color}; padding: 0.5rem 0;">${day}</div>`;
    });

    // Empty cells before first day
    const startDay = firstDay === 0 ? 6 : firstDay - 1;
    for (let i = 0; i < startDay; i++) {
        calendarHTML += '<div style="padding: 0.5rem;"></div>';
    }

    // Days
    for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const isCurrentDay = day === today.getDate() && month === today.getMonth() && year === today.getFullYear();
        
        let bgColor = '#10b981'; // Default: Green (available)
        let textColor = 'white';

        // Past dates - grey
        if (isPastDate(year, month, day)) {
            bgColor = '#e5e7eb';
            textColor = '#9ca3af';
        }
        // Sunday - red (closed)
        else if (isSunday(year, month, day)) {
            bgColor = '#EF4444';
            textColor = 'white';
        }
        // Fully booked (3+ approved) - red
        else if (isFullyBooked(dateStr)) {
            bgColor = '#EF4444';
            textColor = 'white';
        }
        // Has some bookings - yellow
        else if (hasAnyBooking(dateStr)) {
            bgColor = '#F59E0B';
            textColor = 'white';
        }
        // Available - green (default)

        calendarHTML += `<div style="padding: 0.5rem; font-size: 0.875rem; ${isCurrentDay ? 'font-weight: 700; border: 2px solid #B8985F;' : ''} background-color: ${bgColor}; color: ${textColor}; border-radius: 0.25rem;">${day}</div>`;
    }

    document.getElementById('calendarGrid').innerHTML = calendarHTML;
}

function previousMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

// Initialize calendar
renderCalendar();
</script>
@endsection
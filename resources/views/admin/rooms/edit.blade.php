@extends('layouts.app')

@section('title', 'Edit Ruangan - Admin')

@section('content')
<div class="container" style="max-width: 800px; margin: 2rem auto; padding: 0 1rem;">
    <div style="background: white; border-radius: 12px; padding: 2.5rem; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h1 style="font-size: 1.75rem; font-weight: 700; margin-bottom: 2rem;">Form Edit Ruangan</h1>

        {{-- Error Display --}}
        @if ($errors->any())
            <div style="background: #fef2f2; border: 1px solid #ef4444; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem;">
                <ul style="margin: 0; padding-left: 1.25rem; color: #dc2626;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="editForm" action="{{ route('admin.rooms.update', $room) }}" method="POST" enctype="multipart/form-data">
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

            {{-- Dokumentasi Ruangan (3 Separate Slots) --}}
            @php
                // Get all images - check images array first, then fall back to single image
                $allImages = $room->images ?? [];
                if (empty($allImages) && $room->image) {
                    $allImages = [$room->image];
                }
                // Pad array to 3 elements
                while (count($allImages) < 3) {
                    $allImages[] = null;
                }
            @endphp
            <div style="margin-bottom: 2rem;">
                <label style="display: block; font-weight: 600; margin-bottom: 0.5rem; color: #1a1a1a;">Foto Ruangan (Maksimal 3 foto)</label>
                <p style="font-size: 0.875rem; color: #666; margin-bottom: 1rem;">Foto pertama akan menjadi foto profil ruangan.</p>
                
                <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                    @foreach([0, 1, 2] as $index)
                        <div style="width: 140px;">
                            @if($allImages[$index])
                                {{-- Existing Image --}}
                                <div id="slot{{ $index }}" style="position: relative; width: 140px; height: 140px; border-radius: 8px; overflow: hidden; border: 2px solid {{ $index === 0 ? '#B8985F' : '#ddd' }};">
                                    <img src="{{ asset('storage/' . $allImages[$index]) }}" style="width: 100%; height: 100%; object-fit: cover;">
                                    @if($index === 0)
                                        <span style="position: absolute; top: 4px; left: 4px; background: #B8985F; color: white; font-size: 10px; padding: 2px 6px; border-radius: 4px;">Profil</span>
                                    @endif
                                    <button type="button" onclick="removeExisting({{ $index }}, '{{ $allImages[$index] }}')"
                                        style="position: absolute; top: 4px; right: 4px; width: 24px; height: 24px; background: rgba(239,68,68,0.9); border: none; border-radius: 50%; color: white; cursor: pointer; font-size: 14px;">×</button>
                                </div>
                                <input type="hidden" name="delete_images[]" value="" id="delete{{ $index }}" disabled>
                            @else
                                {{-- Empty Slot --}}
                                <div id="slot{{ $index }}">
                                    <div id="preview{{ $index }}" style="display: none; position: relative; width: 140px; height: 140px; border-radius: 8px; overflow: hidden; border: 2px solid #10b981;">
                                        <img id="img{{ $index }}" src="" style="width: 100%; height: 100%; object-fit: cover;">
                                        <span style="position: absolute; top: 4px; left: 4px; background: #10b981; color: white; font-size: 10px; padding: 2px 6px; border-radius: 4px;">Baru</span>
                                        <button type="button" onclick="clearNew({{ $index }})" style="position: absolute; top: 4px; right: 4px; width: 20px; height: 20px; background: rgba(239,68,68,0.9); border: none; border-radius: 50%; color: white; cursor: pointer; font-size: 12px;">×</button>
                                    </div>
                                    <div id="upload{{ $index }}" onclick="document.getElementById('newImage{{ $index }}').click()"
                                        style="width: 140px; height: 140px; border: 2px dashed {{ $index === 0 ? '#B8985F' : '#ddd' }}; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; background: {{ $index === 0 ? '#fffbf0' : '#fafafa' }};">
                                        <svg width="24" height="24" fill="none" stroke="{{ $index === 0 ? '#B8985F' : '#999' }}" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                        <div style="font-size: 0.75rem; color: {{ $index === 0 ? '#B8985F' : '#999' }}; margin-top: 0.5rem;">{{ $index === 0 ? 'Foto Profil' : 'Foto ' . ($index + 1) }}</div>
                                    </div>
                                    <input type="file" id="newImage{{ $index }}" name="images[]" accept=".png,.jpg,.jpeg" style="display: none;" onchange="previewNew(this, {{ $index }})">
                                </div>
                            @endif
                        </div>
                    @endforeach
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
                    
                    <button type="button" onclick="deleteRoom()"
                        style="padding: 0.75rem 2rem; background: #ef4444; color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;"
                        onmouseover="this.style.background='#dc2626'"
                        onmouseout="this.style.background='#ef4444'">
                        Hapus Ruangan
                    </button>
                </div>
                
                <button type="submit"
                    style="padding: 0.75rem 2.5rem; background: linear-gradient(135deg, #B8985F, #9d7d4b); color: white; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: all 0.3s;">
                    Simpan
                </button>
            </div>
        </form>
        
        {{-- Separate delete form (outside main form) --}}
        <form id="deleteForm" action="{{ route('admin.rooms.destroy', $room) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

<script>
function deleteRoom() {
    if (confirm('Apakah Anda yakin ingin menghapus ruangan ini? Data tidak dapat dikembalikan.')) {
        document.getElementById('deleteForm').submit();
    }
}

function deleteImage() {
    if (confirm('Hapus gambar ini?')) {
        document.getElementById('existingImage').style.display = 'none';
        document.getElementById('deleteImageFlag').value = '1';
    }
}

// Calendar implementation
let currentDate = new Date();
const bookings = @json($bookings);
const closures = @json($closures);
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

// H-2 rule: booking must be at least 2 days in advance
function isWithinMinBookingDays(year, month, day) {
    const date = new Date(year, month, day);
    const minBookingDate = new Date(today);
    minBookingDate.setDate(minBookingDate.getDate() + 2);
    return date < minBookingDate;
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

function getClosureInfo(dateStr) {
    return closures[dateStr] || { is_whole_day_closed: false, has_closures: false, count: 0 };
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
        const closureInfo = getClosureInfo(dateStr);
        
        let bgColor = '#10b981'; // Default: Green (available)
        let textColor = 'white';

        // Past dates - grey
        if (isPastDate(year, month, day)) {
            bgColor = '#e5e7eb';
            textColor = '#9ca3af';
        }
        // H-2 rule - light grey
        else if (isWithinMinBookingDays(year, month, day)) {
            bgColor = '#f3f4f6';
            textColor = '#9ca3af';
        }
        // Sunday - red (closed)
        else if (isSunday(year, month, day)) {
            bgColor = '#EF4444';
            textColor = 'white';
        }
        // Room closed (whole day) - dark red/maroon
        else if (closureInfo.is_whole_day_closed) {
            bgColor = '#991b1b';
            textColor = 'white';
        }
        // Has some closures (partial) - yellow
        else if (closureInfo.has_closures) {
            bgColor = '#F59E0B';
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

// Image handling functions
function removeExisting(index, imagePath) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        document.getElementById('slot' + index).innerHTML = `
            <div id="preview${index}" style="display: none; position: relative; width: 140px; height: 140px; border-radius: 8px; overflow: hidden; border: 2px solid #10b981;">
                <img id="img${index}" src="" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 4px; left: 4px; background: #10b981; color: white; font-size: 10px; padding: 2px 6px; border-radius: 4px;">Baru</span>
                <button type="button" onclick="clearNew(${index})" style="position: absolute; top: 4px; right: 4px; width: 20px; height: 20px; background: rgba(239,68,68,0.9); border: none; border-radius: 50%; color: white; cursor: pointer; font-size: 12px;">×</button>
            </div>
            <div id="upload${index}" onclick="document.getElementById('newImage${index}').click()"
                style="width: 140px; height: 140px; border: 2px dashed #ddd; border-radius: 8px; display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; background: #fafafa;">
                <svg width="24" height="24" fill="none" stroke="#999" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                <div style="font-size: 0.75rem; color: #999; margin-top: 0.5rem;">Foto ${index + 1}</div>
            </div>
            <input type="file" id="newImage${index}" name="images[]" accept=".png,.jpg,.jpeg" style="display: none;" onchange="previewNew(this, ${index})">
        `;
        const deleteInput = document.getElementById('delete' + index);
        if (deleteInput) {
            deleteInput.value = imagePath;
            deleteInput.disabled = false;
        } else {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'delete_images[]';
            input.value = imagePath;
            document.getElementById('editForm').appendChild(input);
        }
    }
}

function previewNew(input, index) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('img' + index).src = e.target.result;
            document.getElementById('preview' + index).style.display = 'block';
            document.getElementById('upload' + index).style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function clearNew(index) {
    document.getElementById('newImage' + index).value = '';
    document.getElementById('preview' + index).style.display = 'none';
    document.getElementById('upload' + index).style.display = 'flex';
}
</script>
@endsection
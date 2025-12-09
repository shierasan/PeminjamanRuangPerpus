<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use App\Models\Notification;
use App\Models\Announcement;
use App\Models\Aspiration;
use App\Models\RoomClosure;
use Carbon\Carbon;

/**
 * Demo Data Seeder untuk Presentasi Client
 * Menampilkan berbagai fitur sistem peminjaman ruangan
 */
class DemoBookingSeeder extends Seeder
{
    public function run(): void
    {
        // Get existing users and rooms
        $admin = User::where('role', 'admin')->first();
        $users = User::where('role', 'user')->get();
        $rooms = Room::all();

        if ($users->isEmpty() || $rooms->isEmpty()) {
            echo "⚠️ Jalankan UserSeeder dan RoomSeeder terlebih dahulu!\n";
            return;
        }

        // ============================================
        // 1. PEMINJAMAN DENGAN STATUS BERBEDA
        // ============================================

        $today = Carbon::today();

        // --- Peminjaman PENDING (Menunggu Persetujuan) ---
        // Pengajuan baru yang perlu diproses admin

        $booking1 = Booking::create([
            'user_id' => $users[0]->id,
            'room_id' => $rooms[0]->id, // Gibei Corner
            'booking_date' => $today->copy()->addDays(3),
            'start_time' => '09:00',
            'end_time' => '12:00',
            'event_name' => 'Seminar Kewirausahaan Digital',
            'organizer' => 'Himpunan Mahasiswa Informatika',
            'participants_count' => 35,
            'status' => 'pending',
        ]);

        $booking2 = Booking::create([
            'user_id' => $users[1]->id ?? $users[0]->id,
            'room_id' => $rooms[1]->id ?? $rooms[0]->id, // The Gade
            'booking_date' => $today->copy()->addDays(4),
            'start_time' => '13:00',
            'end_time' => '16:00',
            'event_name' => 'Workshop UI/UX Design',
            'organizer' => 'Kelompok Studi Mobile Development',
            'participants_count' => 40,
            'status' => 'pending',
        ]);

        $booking3 = Booking::create([
            'user_id' => $users[2]->id ?? $users[0]->id,
            'room_id' => $rooms[2]->id ?? $rooms[0]->id, // American Corner
            'booking_date' => $today->copy()->addDays(5),
            'start_time' => '08:00',
            'end_time' => '11:00',
            'event_name' => 'Pelatihan Public Speaking',
            'organizer' => 'English Club Unand',
            'participants_count' => 50,
            'status' => 'pending',
        ]);

        // --- Peminjaman APPROVED (Disetujui) ---
        // Menunjukkan peminjaman yang sudah disetujui

        $booking4 = Booking::create([
            'user_id' => $users[0]->id,
            'room_id' => $rooms[0]->id, // Gibei Corner
            'booking_date' => $today->copy()->addDays(2),
            'start_time' => '14:00',
            'end_time' => '17:00',
            'event_name' => 'Rapat Kerja BEM Fakultas',
            'organizer' => 'BEM Fakultas Teknik',
            'participants_count' => 30,
            'status' => 'approved',
            'admin_note' => 'Disetujui. Harap menjaga kebersihan ruangan.',
        ]);

        $booking5 = Booking::create([
            'user_id' => $users[1]->id ?? $users[0]->id,
            'room_id' => $rooms[3]->id ?? $rooms[0]->id, // Ruang Diskusi A
            'booking_date' => $today->copy()->addDays(3),
            'start_time' => '10:00',
            'end_time' => '12:00',
            'event_name' => 'Diskusi Kelompok Tugas Akhir',
            'organizer' => 'Tim Penelitian Machine Learning',
            'participants_count' => 15,
            'status' => 'approved',
            'admin_note' => 'Disetujui untuk kegiatan akademik.',
        ]);

        // --- Peminjaman REJECTED (Ditolak) ---
        // Contoh peminjaman yang ditolak dengan alasan

        Booking::create([
            'user_id' => $users[0]->id,
            'room_id' => $rooms[0]->id,
            'booking_date' => $today->copy()->addDays(6),
            'start_time' => '08:00',
            'end_time' => '17:00',
            'event_name' => 'Acara Komunitas Gaming',
            'organizer' => 'Komunitas Gamers',
            'participants_count' => 40,
            'status' => 'rejected',
            'admin_note' => 'Mohon maaf, ruangan sudah dipesan untuk acara resmi fakultas pada tanggal tersebut. Silakan pilih tanggal lain.',
        ]);

        // --- Peminjaman dengan Request Pembatalan ---
        // Demo fitur pembatalan oleh user

        Booking::create([
            'user_id' => $users[1]->id ?? $users[0]->id,
            'room_id' => $rooms[1]->id ?? $rooms[0]->id,
            'booking_date' => $today->copy()->addDays(4),
            'start_time' => '09:00',
            'end_time' => '11:00',
            'event_name' => 'Rapat Koordinasi Panitia',
            'organizer' => 'Panitia Dies Natalis',
            'participants_count' => 25,
            'status' => 'approved',
            'cancellation_requested' => true,
            'cancellation_status' => 'pending',
            'cancellation_reason' => 'Mohon maaf, acara kami dipindahkan ke venue lain karena ada perubahan jadwal dari pimpinan.',
        ]);

        // --- Peminjaman yang sudah CANCELLED ---

        Booking::create([
            'user_id' => $users[2]->id ?? $users[0]->id,
            'room_id' => $rooms[2]->id ?? $rooms[0]->id,
            'booking_date' => $today->copy()->subDays(2),
            'start_time' => '13:00',
            'end_time' => '16:00',
            'event_name' => 'Seminar Kesehatan Mental',
            'organizer' => 'Unit Konseling Mahasiswa',
            'participants_count' => 50,
            'status' => 'cancelled',
            'cancellation_requested' => true,
            'cancellation_status' => 'approved',
            'cancellation_reason' => 'Pembicara berhalangan hadir, acara ditunda ke bulan depan.',
        ]);

        // --- Riwayat Peminjaman Lama (untuk demo Riwayat) ---

        Booking::create([
            'user_id' => $users[0]->id,
            'room_id' => $rooms[0]->id,
            'booking_date' => $today->copy()->subDays(7),
            'start_time' => '09:00',
            'end_time' => '12:00',
            'event_name' => 'Workshop Data Science',
            'organizer' => 'Himpunan Mahasiswa Statistika',
            'participants_count' => 35,
            'status' => 'approved',
            'admin_note' => 'Kegiatan berjalan lancar.',
            'key_returned' => true,
            'key_returned_at' => $today->copy()->subDays(7)->setTime(12, 30),
        ]);

        Booking::create([
            'user_id' => $users[1]->id ?? $users[0]->id,
            'room_id' => $rooms[1]->id ?? $rooms[0]->id,
            'booking_date' => $today->copy()->subDays(5),
            'start_time' => '14:00',
            'end_time' => '17:00',
            'event_name' => 'Pelatihan Microsoft Office',
            'organizer' => 'Pusat Komputer Unand',
            'participants_count' => 30,
            'status' => 'approved',
            'admin_note' => 'Terima kasih telah menggunakan fasilitas dengan baik.',
            'key_returned' => true,
            'key_returned_at' => $today->copy()->subDays(5)->setTime(17, 15),
        ]);

        // ============================================
        // DEMO FITUR PENGEMBALIAN KUNCI
        // ============================================

        // Gunakan tanggal KEMARIN agar besok pagi jam 8 pasti tampil "Menunggu Kunci"
        $yesterday = $today->copy()->subDays(1); // 8 Desember 2025

        // --- 1. Peminjaman MENUNGGU PENGEMBALIAN KUNCI ---
        // Booking KEMARIN yang sudah selesai tapi kunci belum dikembalikan
        // Akan tampil "Menunggu Kunci" saat presentasi besok jam 8 pagi

        $waitingKeyBooking1 = Booking::create([
            'user_id' => $users[1]->id ?? $users[0]->id,
            'room_id' => $rooms[1]->id ?? $rooms[0]->id, // The Gade
            'booking_date' => $yesterday, // KEMARIN!
            'start_time' => '14:00', // Siang kemarin jam 2
            'end_time' => '17:00',   // Selesai jam 5 sore KEMARIN
            'event_name' => 'Workshop Desain Grafis',
            'organizer' => 'UKM Seni dan Desain',
            'participants_count' => 25,
            'status' => 'approved',
            'admin_note' => 'Disetujui.',
            'key_returned' => false, // KUNCI BELUM DIKEMBALIKAN!
        ]);

        $waitingKeyBooking2 = Booking::create([
            'user_id' => $users[2]->id ?? $users[0]->id,
            'room_id' => $rooms[2]->id ?? $rooms[0]->id, // American Corner
            'booking_date' => $yesterday, // KEMARIN!
            'start_time' => '09:00', // Pagi kemarin jam 9
            'end_time' => '12:00',   // Selesai jam 12 siang KEMARIN
            'event_name' => 'Kuliah Tamu - Digital Marketing',
            'organizer' => 'Prodi Manajemen',
            'participants_count' => 55,
            'status' => 'approved',
            'admin_note' => 'Sudah disetujui oleh Kepala Perpustakaan.',
            'key_returned' => false, // KUNCI BELUM DIKEMBALIKAN!
        ]);

        $waitingKeyBooking3 = Booking::create([
            'user_id' => $users[0]->id,
            'room_id' => $rooms[3]->id ?? $rooms[0]->id, // Ruang Diskusi A
            'booking_date' => $yesterday, // KEMARIN!
            'start_time' => '13:00', // Siang kemarin jam 1
            'end_time' => '16:00',   // Selesai jam 4 sore KEMARIN
            'event_name' => 'Rapat Tim Proyek Akhir',
            'organizer' => 'Kelompok TA Informatika',
            'participants_count' => 10,
            'status' => 'approved',
            'admin_note' => 'Disetujui.',
            'key_returned' => false, // KUNCI BELUM DIKEMBALIKAN!
        ]);

        // --- 2. Peminjaman yang kunci sudah dikembalikan (kemarin) ---
        // Contoh kasus ideal dimana kunci dikembalikan tepat waktu

        Booking::create([
            'user_id' => $users[0]->id,
            'room_id' => $rooms[4]->id ?? $rooms[0]->id, // Ruang Multimedia
            'booking_date' => $yesterday,
            'start_time' => '08:00',
            'end_time' => '10:00',
            'event_name' => 'FGD Penelitian Skripsi',
            'organizer' => 'Tim Penelitian Ekonomi Digital',
            'participants_count' => 12,
            'status' => 'approved',
            'admin_note' => 'Terima kasih, kunci sudah dikembalikan tepat waktu.',
            'key_returned' => true,
            'key_returned_at' => $yesterday->copy()->setTime(10, 15),
        ]);

        // Notifikasi terkait pengembalian kunci untuk admin
        if ($admin) {
            Notification::create([
                'user_id' => $admin->id,
                'booking_id' => $waitingKeyBooking1->id,
                'type' => 'key_pending',
                'title' => '🔑 Kunci Belum Dikembalikan',
                'message' => 'UKM Seni dan Desain belum mengembalikan kunci The Gade Creative Lounge. Waktu peminjaman sudah selesai 1 jam lalu.',
                'link' => '/admin/bookings/' . $waitingKeyBooking1->id,
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $admin->id,
                'booking_id' => $waitingKeyBooking2->id,
                'type' => 'key_pending',
                'title' => '🔑 Kunci Belum Dikembalikan',
                'message' => 'Prodi Manajemen belum mengembalikan kunci American Corner. Waktu peminjaman sudah selesai 2 jam lalu.',
                'link' => '/admin/bookings/' . $waitingKeyBooking2->id,
                'is_read' => false,
            ]);
        }

        // ============================================
        // 2. NOTIFIKASI UNTUK DEMO
        // ============================================

        if ($admin) {
            // Notifikasi pengajuan baru
            Notification::create([
                'user_id' => $admin->id,
                'booking_id' => $booking1->id,
                'type' => 'new_booking',
                'title' => 'Pengajuan Peminjaman Baru',
                'message' => 'Himpunan Mahasiswa Informatika mengajukan peminjaman Gibei Corner untuk "Seminar Kewirausahaan Digital".',
                'link' => '/admin/bookings/' . $booking1->id,
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $admin->id,
                'booking_id' => $booking2->id,
                'type' => 'new_booking',
                'title' => 'Pengajuan Peminjaman Baru',
                'message' => 'Kelompok Studi Mobile Development mengajukan peminjaman The Gade Creative Lounge untuk "Workshop UI/UX Design".',
                'link' => '/admin/bookings/' . $booking2->id,
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $admin->id,
                'type' => 'cancellation_request',
                'title' => 'Permintaan Pembatalan',
                'message' => 'Panitia Dies Natalis mengajukan pembatalan peminjaman ruangan.',
                'link' => '/admin/cancellations',
                'is_read' => false,
            ]);
        }

        // Notifikasi untuk user
        Notification::create([
            'user_id' => $users[0]->id,
            'booking_id' => $booking4->id,
            'type' => 'booking_approved',
            'title' => 'Peminjaman Disetujui! ✓',
            'message' => 'Peminjaman Gibei Corner untuk "Rapat Kerja BEM Fakultas" telah disetujui.',
            'link' => '/user/bookings/' . $booking4->id,
            'is_read' => false,
        ]);

        // ============================================
        // 3. PENGUMUMAN DEMO
        // ============================================

        Announcement::updateOrCreate(
            ['title' => 'Jam Operasional Perpustakaan Selama UAS'],
            [
                'content' => 'Dalam rangka mendukung kegiatan Ujian Akhir Semester, perpustakaan akan memperpanjang jam operasional menjadi 07.00 - 22.00 WIB mulai tanggal 16 Desember 2025 hingga 10 Januari 2026. Silakan manfaatkan fasilitas dengan baik.',
                'is_active' => true,
                'published_date' => $today,
            ]
        );

        Announcement::updateOrCreate(
            ['title' => 'Pemeliharaan Sistem'],
            [
                'content' => 'Sistem SIPRUS akan mengalami pemeliharaan rutin pada hari Minggu, 15 Desember 2025 pukul 00.00 - 04.00 WIB. Selama waktu tersebut, layanan peminjaman online tidak dapat diakses.',
                'is_active' => true,
                'published_date' => $today->copy()->subDays(1),
            ]
        );

        Announcement::updateOrCreate(
            ['title' => 'Selamat Datang di SIPRUS!'],
            [
                'content' => 'Selamat datang di SIPRUS - Sistem Peminjaman Ruang Pustaka Universitas Andalas. Sistem ini memudahkan Anda untuk melakukan reservasi ruangan perpustakaan secara online. Pastikan membaca syarat dan ketentuan sebelum melakukan peminjaman.',
                'is_active' => true,
                'published_date' => $today->copy()->subDays(7),
            ]
        );

        // ============================================
        // 4. ASPIRASI/PENGADUAN DEMO
        // ============================================

        Aspiration::updateOrCreate(
            ['title' => 'Penambahan Jam Operasional Weekend'],
            [
                'user_id' => $users[0]->id,
                'room_id' => $rooms[0]->id,
                'description' => 'Saya berharap ruang diskusi di perpustakaan dapat dibuka pada hari Sabtu untuk mengakomodasi mahasiswa yang ingin belajar kelompok di akhir pekan. Terutama saat mendekati UAS, banyak mahasiswa yang membutuhkan tempat belajar bersama.',
                'status' => 'pending',
            ]
        );

        Aspiration::updateOrCreate(
            ['title' => 'AC Ruang Multimedia Kurang Dingin'],
            [
                'user_id' => $users[1]->id ?? $users[0]->id,
                'room_id' => $rooms[4]->id ?? $rooms[0]->id,
                'description' => 'AC di Ruang Multimedia terasa kurang dingin, terutama saat ruangan penuh dengan peserta workshop. Mohon dilakukan pengecekan dan perbaikan agar kenyamanan pengguna ruangan tetap terjaga.',
                'status' => 'pending',
            ]
        );

        // ============================================
        // 5. PENUTUPAN RUANGAN DEMO
        // ============================================

        RoomClosure::updateOrCreate(
            [
                'room_id' => $rooms[0]->id,
                'closure_date' => $today->copy()->addDays(7),
            ],
            [
                'start_time' => null,
                'end_time' => null,
                'reason' => 'Pemeliharaan AC dan Proyektor',
            ]
        );

        RoomClosure::updateOrCreate(
            [
                'room_id' => null, // Semua ruangan
                'closure_date' => $today->copy()->addDays(14),
            ],
            [
                'start_time' => null,
                'end_time' => null,
                'reason' => 'Libur Hari Raya Natal 2025',
            ]
        );

        echo "\n";
        echo "✅ Demo data berhasil dibuat untuk presentasi!\n";
        echo "================================================\n";
        echo "📋 RINGKASAN DATA DEMO:\n";
        echo "================================================\n";
        echo "📌 Peminjaman:\n";
        echo "   - 3 Pending (menunggu persetujuan)\n";
        echo "   - 2 Approved (disetujui untuk masa depan)\n";
        echo "   - 1 Rejected (ditolak dengan alasan)\n";
        echo "   - 1 Menunggu Pembatalan\n";
        echo "   - 1 Cancelled (sudah dibatalkan)\n";
        echo "   - 2 Riwayat lama (kunci sudah dikembalikan)\n";
        echo "\n";
        echo "🔑 DEMO PENGEMBALIAN KUNCI:\n";
        echo "   - 1 Sedang Berlangsung (in progress)\n";
        echo "   - 2 Menunggu Pengembalian Kunci (!)\n";
        echo "   - 1 Kunci baru dikembalikan (hari ini)\n";
        echo "\n";
        echo "🔔 Notifikasi:\n";
        echo "   - 5 notifikasi untuk Admin (termasuk 2 tentang kunci)\n";
        echo "   - 1 notifikasi untuk User\n";
        echo "\n";
        echo "📢 Pengumuman: 3 pengumuman aktif\n";
        echo "💬 Aspirasi: 2 aspirasi pending\n";
        echo "🔒 Penutupan Ruangan: 2 jadwal penutupan\n";
        echo "\n";
        echo "================================================\n";
        echo "🎯 LOGIN CREDENTIALS:\n";
        echo "================================================\n";
        echo "Admin: admin@unand.ac.id / admin123\n";
        echo "User:  budi@student.unand.ac.id / password123\n";
        echo "User:  siti@student.unand.ac.id / password123\n";
        echo "================================================\n";
    }
}

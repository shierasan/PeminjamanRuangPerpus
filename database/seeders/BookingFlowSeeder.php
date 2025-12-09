<?php

namespace Database\Seeders;

use App\Models\BookingFlow;
use Illuminate\Database\Seeder;

class BookingFlowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $steps = [
            [
                'step_number' => 1,
                'title' => 'Login ke Akun SIPRUS',
                'description' => 'Masuk ke sistem menggunakan akun email Universitas Andalas Anda. Jika belum memiliki akun, silakan daftar terlebih dahulu melalui halaman registrasi.',
            ],
            [
                'step_number' => 2,
                'title' => 'Pilih Ruangan',
                'description' => 'Lihat daftar ruangan yang tersedia di menu "Peminjaman". Anda dapat melihat detail ruangan seperti kapasitas, fasilitas, dan foto ruangan. Pilih ruangan yang sesuai dengan kebutuhan Anda.',
            ],
            [
                'step_number' => 3,
                'title' => 'Tentukan Jadwal Peminjaman',
                'description' => 'Pilih tanggal dan waktu peminjaman yang diinginkan. Pastikan jadwal yang dipilih tidak bertabrakan dengan peminjaman lain. Sistem akan menampilkan ketersediaan ruangan secara real-time.',
            ],
            [
                'step_number' => 4,
                'title' => 'Isi Formulir Peminjaman',
                'description' => 'Lengkapi formulir peminjaman dengan informasi yang diperlukan: nama acara/kegiatan, deskripsi kegiatan, jumlah peserta, dan nama penanggung jawab.',
            ],
            [
                'step_number' => 5,
                'title' => 'Kirim Pengajuan',
                'description' => 'Setelah semua data terisi dengan benar, klik tombol "Ajukan Peminjaman" untuk mengirim permohonan Anda ke admin perpustakaan.',
            ],
            [
                'step_number' => 6,
                'title' => 'Tunggu Konfirmasi',
                'description' => 'Admin akan mereview pengajuan Anda. Anda akan menerima notifikasi melalui sistem ketika pengajuan disetujui atau ditolak. Proses review biasanya memakan waktu 1-2 hari kerja.',
            ],
            [
                'step_number' => 7,
                'title' => 'Pengambilan Kunci',
                'description' => 'Jika pengajuan disetujui, datang ke counter perpustakaan pada waktu yang telah ditentukan untuk mengambil kunci ruangan. Bawa identitas dan tunjukkan bukti persetujuan peminjaman.',
            ],
            [
                'step_number' => 8,
                'title' => 'Pengembalian Kunci',
                'description' => 'Setelah selesai menggunakan ruangan, kembalikan kunci ke counter perpustakaan. Pastikan ruangan dalam kondisi bersih dan rapi. Status peminjaman akan diperbarui setelah kunci dikembalikan.',
            ],
        ];

        foreach ($steps as $step) {
            BookingFlow::updateOrCreate(
                ['step_number' => $step['step_number']],
                $step
            );
        }
    }
}

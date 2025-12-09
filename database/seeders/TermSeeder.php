<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing terms first
        Term::whereIn('category', ['persyaratan_umum', 'larangan'])->delete();

        $terms = [
            // Persyaratan Umum
            [
                'category' => 'persyaratan_umum',
                'content' => 'Peminjam adalah sivitas akademika Universitas Andalas yang memiliki akun SIPRUS yang valid.',
                'order' => 1,
            ],
            [
                'category' => 'persyaratan_umum',
                'content' => 'Peminjam harus mengisi formulir peminjaman dengan data yang benar dan lengkap.',
                'order' => 2,
            ],
            [
                'category' => 'persyaratan_umum',
                'content' => 'Pengajuan peminjaman harus dilakukan minimal 2 (dua) hari kerja sebelum tanggal penggunaan.',
                'order' => 3,
            ],
            [
                'category' => 'persyaratan_umum',
                'content' => 'Ruangan hanya dapat digunakan untuk kegiatan akademik, organisasi kemahasiswaan, dan kegiatan resmi yang tidak melanggar peraturan universitas.',
                'order' => 4,
            ],
            [
                'category' => 'persyaratan_umum',
                'content' => 'Peminjam bertanggung jawab penuh atas keamanan, kebersihan, dan keutuhan fasilitas ruangan selama masa penggunaan.',
                'order' => 5,
            ],
            [
                'category' => 'persyaratan_umum',
                'content' => 'Kunci ruangan harus diambil dan dikembalikan ke counter perpustakaan sesuai jadwal yang telah disetujui.',
                'order' => 6,
            ],
            [
                'category' => 'persyaratan_umum',
                'content' => 'Pembatalan peminjaman harus dilakukan minimal 24 jam sebelum waktu penggunaan melalui sistem SIPRUS.',
                'order' => 7,
            ],

            // Larangan
            [
                'category' => 'larangan',
                'content' => 'Dilarang merokok di dalam ruangan perpustakaan.',
                'order' => 1,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang membawa makanan dan minuman yang dapat mengotori ruangan.',
                'order' => 2,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang membawa hewan peliharaan ke dalam area perpustakaan.',
                'order' => 3,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang memindahkan peralatan atau furnitur tanpa izin dari pengelola perpustakaan.',
                'order' => 4,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang melakukan kegiatan yang mengganggu ketenangan pengguna perpustakaan lainnya.',
                'order' => 5,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang menggunakan ruangan melebihi waktu yang telah disetujui tanpa perpanjangan resmi.',
                'order' => 6,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang membuang sampah sembarangan, sampah harus dibuang pada tempat yang telah disediakan.',
                'order' => 7,
            ],
            [
                'category' => 'larangan',
                'content' => 'Dilarang melakukan kegiatan yang melanggar norma kesusilaan dan peraturan universitas.',
                'order' => 8,
            ],
        ];

        foreach ($terms as $term) {
            Term::create($term);
        }
    }
}

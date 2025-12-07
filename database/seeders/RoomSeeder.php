<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;

class RoomSeeder extends Seeder
{
    public function run()
    {
        $rooms = [
            [
                'name' => 'Gibei Corner',
                'floor' => '1',
                'capacity' => 45,
                'facilities' => ['Proyektor', 'Whiteboard', 'AC', 'WiFi'],
                'description' => 'Ruang bersahabat besar yang cocok digunakan untuk kegiatan seperti seminar, workshop, dan pertemuan.',
                'is_available' => true,
            ],
            [
                'name' => 'The Gade Creative Lounge',
                'floor' => '2',
                'capacity' => 50,
                'facilities' => ['Proyektor', 'Sound System', 'AC', 'WiFi', 'Meja Bundar'],
                'description' => 'Ruang berkonsep besar yang cocok digunakan untuk kegiatan seperti diskusi kelompok dan brainstorming.',
                'is_available' => true,
            ],
            [
                'name' => 'American Corner',
                'floor' => '2',
                'capacity' => 61,
                'facilities' => ['Proyektor', 'Whiteboard', 'AC', 'WiFi', 'Kursi Auditorium'],
                'description' => 'Ruang presentasi dengan kapasitas besar untuk acara formal dan kuliah tamu.',
                'is_available' => true,
            ],
            [
                'name' => 'Ruang Diskusi A',
                'floor' => '1',
                'capacity' => 20,
                'facilities' => ['Whiteboard', 'AC', 'WiFi'],
                'description' => 'Ruang kecil untuk diskusi kelompok dan rapat tim.',
                'is_available' => true,
            ],
            [
                'name' => 'Ruang Multimedia',
                'floor' => '3',
                'capacity' => 30,
                'facilities' => ['Komputer', 'Proyektor', 'AC', 'WiFi', 'Sound System'],
                'description' => 'Ruang dengan fasilitas multimedia lengkap untuk presentasi dan pelatihan.',
                'is_available' => true,
            ],
            [
                'name' => 'Lab Komputer',
                'floor' => '4',
                'capacity' => 40,
                'facilities' => ['Komputer', 'Proyektor', 'AC', 'WiFi'],
                'description' => 'Lab komputer dengan PC untuk pelatihan dan praktikum.',
                'is_available' => true,
            ],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }

        echo "✅ " . count($rooms) . " ruangan berhasil ditambahkan!\n";
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Notification;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Admin Perpustakaan',
            'email' => 'admin@unand.ac.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Sample Regular Users
        $user1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.unand.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@student.unand.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@student.unand.ac.id',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);

        // Create Display User
        User::create([
            'name' => 'Display Monitor',
            'email' => 'display@unand.ac.id',
            'password' => Hash::make('display123'),
            'role' => 'display',
        ]);

        // Create sample notification for admin (for testing)
        Notification::create([
            'user_id' => $admin->id,
            'type' => 'new_booking',
            'title' => 'Sample: Ada peminjaman ruangan baru',
            'message' => 'Ini adalah notifikasi contoh untuk testing sistem.',
            'link' => '/admin/bookings',
            'is_read' => false,
        ]);
    }
}

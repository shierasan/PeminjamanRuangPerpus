<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('phone_title')->default('Penjaga Perpustakaan');
            $table->string('phone_number')->default('0899 0087 1234');
            $table->string('email_title')->default('Admin Perpustakaan');
            $table->string('email_address')->default('lib.unand.ac@gmail.com');
            $table->string('location_title')->default('Perpustakaan Universitas Andalas');
            $table->text('location_address')->default('Kampus Universitas Andalas, Limau Manis, Kec. Pauh, Kota Padang.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};

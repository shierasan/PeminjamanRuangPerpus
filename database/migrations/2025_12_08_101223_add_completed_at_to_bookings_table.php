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
        Schema::table('bookings', function (Blueprint $table) {
            $table->timestamp('completed_at')->nullable()->after('status');
            $table->boolean('key_returned')->default(false)->after('completed_at');
            $table->timestamp('key_returned_at')->nullable()->after('key_returned');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['completed_at', 'key_returned', 'key_returned_at']);
        });
    }
};

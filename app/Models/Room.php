<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'floor',
        'capacity',
        'facilities',
        'description',
        'image',
        'images', // Array of up to 3 images
        'is_available',
        'contact_name',
        'contact_phone',
    ];

    protected $casts = [
        'facilities' => 'array',
        'images' => 'array',
        'is_available' => 'boolean',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}

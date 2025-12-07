<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_title',
        'phone_number',
        'email_title',
        'email_address',
        'location_title',
        'location_address',
    ];
}

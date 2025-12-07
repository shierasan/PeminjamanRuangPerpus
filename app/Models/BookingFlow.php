<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFlow extends Model
{
    use HasFactory;

    protected $fillable = [
        'step_number',
        'title',
        'description',
        'image',
    ];

    /**
     * Get all steps ordered by step number.
     */
    public static function getOrderedSteps()
    {
        return self::orderBy('step_number')->get();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'booking_date',
        'start_time',
        'end_time',
        'event_name',
        'organizer',
        'participants_count',
        'letter_file',
        'rundown_file',
        'status',
        'admin_note',
        'cancellation_requested',
        'cancellation_status',
        'cancellation_reason',
        'completed_at',
        'key_returned',
        'key_returned_at',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'completed_at' => 'datetime',
        'key_returned_at' => 'datetime',
        'key_returned' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Check if booking time has ended
     */
    public function isTimeEnded(): bool
    {
        if ($this->status !== 'approved') {
            return false;
        }

        $bookingEnd = Carbon::parse($this->booking_date->format('Y-m-d') . ' ' . $this->end_time);
        return Carbon::now()->gte($bookingEnd);
    }

    /**
     * Check if booking is currently active (in progress)
     */
    public function isInProgress(): bool
    {
        if ($this->status !== 'approved') {
            return false;
        }

        $now = Carbon::now();
        $bookingStart = Carbon::parse($this->booking_date->format('Y-m-d') . ' ' . $this->start_time);
        $bookingEnd = Carbon::parse($this->booking_date->format('Y-m-d') . ' ' . $this->end_time);

        return $now->gte($bookingStart) && $now->lt($bookingEnd);
    }

    /**
     * Check if booking is waiting for key return
     */
    public function isWaitingKeyReturn(): bool
    {
        return $this->isTimeEnded() && !$this->key_returned;
    }
}

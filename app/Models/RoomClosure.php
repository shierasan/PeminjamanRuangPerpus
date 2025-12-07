<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomClosure extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'closure_date',
        'start_time',
        'end_time',
        'reason',
    ];

    protected $casts = [
        'closure_date' => 'date',
    ];

    /**
     * Get the room associated with this closure.
     * Null means all rooms are closed.
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    /**
     * Check if this closure is for all rooms.
     */
    public function isAllRooms()
    {
        return is_null($this->room_id);
    }

    /**
     * Check if this closure is for the whole day.
     */
    public function isWholeDay()
    {
        return is_null($this->start_time) && is_null($this->end_time);
    }

    /**
     * Scope to get closures for a specific room (including all-room closures).
     */
    public function scopeForRoom($query, $roomId)
    {
        return $query->where(function ($q) use ($roomId) {
            $q->whereNull('room_id') // all rooms
                ->orWhere('room_id', $roomId);
        });
    }

    /**
     * Scope to get closures for a specific date.
     */
    public function scopeForDate($query, $date)
    {
        return $query->where('closure_date', $date);
    }

    /**
     * Check if a given time range conflicts with this closure.
     */
    public function conflictsWith($startTime, $endTime)
    {
        // If whole day closure, always conflicts
        if ($this->isWholeDay()) {
            return true;
        }

        // Check time overlap
        return $startTime < $this->end_time && $endTime > $this->start_time;
    }
}

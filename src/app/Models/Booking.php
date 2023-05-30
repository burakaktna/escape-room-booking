<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

// TODO amount
class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'time_slot_id', 'participant_count', 'escape_room_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function escapeRoom(): BelongsTo
    {
        return $this->belongsTo(EscapeRoom::class);
    }

    public function timeSlot(): BelongsTo
    {
        return $this->belongsTo(TimeSlot::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'type', 'amount'];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}

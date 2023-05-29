<?php

namespace App\Http\Resources\TimeSlot;

use App\Models\TimeSlot;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin TimeSlot */
class TimeSlotResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'escape_room_id' => $this->escape_room_id
        ];
    }
}

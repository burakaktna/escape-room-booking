<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'time_slot_id' => 'required|exists:time_slots,id',
            'escape_room_id' => 'required|exists:escape_rooms,id',
            'participant_count' => 'required|integer|min:1',
        ];
    }
}

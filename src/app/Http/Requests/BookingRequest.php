<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'escape_room_id' => 'required|exists:escape_rooms,id',
            'time_slot_id' => 'required|exists:time_slots,id',
            'participant_count' => 'required|integer'
        ];
    }
}

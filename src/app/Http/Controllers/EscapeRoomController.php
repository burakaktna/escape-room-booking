<?php

namespace App\Http\Controllers;

use App\Http\Resources\EscapeRoom\EscapeRoomCollection;
use App\Http\Resources\EscapeRoom\EscapeRoomResource;
use App\Http\Resources\TimeSlot\TimeSlotCollection;
use App\Models\EscapeRoom;
use Illuminate\Http\JsonResponse;

class EscapeRoomController extends Controller
{
    public function index(): JsonResponse
    {
        $escapeRooms = EscapeRoom::all();
        return EscapeRoomCollection::make($escapeRooms)->response();
    }

    public function show(EscapeRoom $escapeRoom)
    {
        return EscapeRoomResource::make($escapeRoom)->response();
    }

    public function timeSlots(EscapeRoom $escapeRoom)
    {
        // Assuming the time slots are stored as a relationship
        $timeSlots = $escapeRoom->timeSlots;
        return TimeSlotCollection::make($timeSlots)->response();
    }
}

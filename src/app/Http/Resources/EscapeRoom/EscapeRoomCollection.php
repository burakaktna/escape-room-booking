<?php

namespace App\Http\Resources\EscapeRoom;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\EscapeRoom */
class EscapeRoomCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => EscapeRoomResource::collection($this->collection),
        ];
    }
}

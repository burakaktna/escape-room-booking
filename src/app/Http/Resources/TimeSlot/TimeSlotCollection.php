<?php

namespace App\Http\Resources\TimeSlot;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\TimeSlot */
class TimeSlotCollection extends ResourceCollection
{
    /**
     * @param Request $request
     * @return array
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => TimeSlotResource::collection($this->collection),
        ];
    }
}

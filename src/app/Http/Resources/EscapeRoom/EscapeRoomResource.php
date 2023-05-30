<?php

namespace App\Http\Resources\EscapeRoom;

use App\Models\EscapeRoom;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin EscapeRoom */
class EscapeRoomResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'theme' => $this->theme,
            'capacity' => $this->capacity
        ];
    }
}

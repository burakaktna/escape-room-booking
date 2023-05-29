<?php

namespace App\Http\Resources\Discount;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

/** @see \App\Models\Discount */
class DiscountCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        return [
            'data' => DiscountResource::collection($this->collection),
        ];
    }
}

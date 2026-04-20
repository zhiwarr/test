<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price_in_iqd' => $this->price_in_iqd,
            'price_in_usd' => $this->price_in_usd,
            'quantity' => $this->quantity,
            'total_price_in_usd' => $this->total_price_in_usd,
            'total_price_in_iqd' => $this->total_price_in_iqd,
            'category' => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}

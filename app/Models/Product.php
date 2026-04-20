<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['name', 'price_in_usd', 'price_in_iqd', 'quantity', 'category_id'])]
class Product extends BaseModel
{
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function totalPriceInUsd(): Attribute
    {
        return Attribute::get(
            fn() => $this->price_in_usd * $this->quantity,
        );
    }
    public function totalPriceInIqd(): Attribute
    {
        return Attribute::get(
            fn() => $this->price_in_iqd * $this->quantity,
        );
    }

    public function casts(): array
    {
        return [
            'price_in_usd' => 'float',
            'price_in_iqd' => 'float',
            'quantity' => 'integer',
        ];
    }
}

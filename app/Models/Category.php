<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]
class Category extends BaseModel
{
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'symbol'])]
class Unit extends Model
{
    use HasFactory;

    public function wasteCategories(): HasMany
    {
        return $this->hasMany(WasteCategory::class);
    }
}

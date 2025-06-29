<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $guarded = [];


    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function inputProducts(): HasMany
    {
        return $this->hasMany(InputProduct::class);
    }

    public function outputProducts(): HasMany
    {
        return $this->hasMany(OutputProduct::class);
    }

    protected $casts = [
        "residue" => "float",
    ];
}

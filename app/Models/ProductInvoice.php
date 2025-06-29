<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductInvoice extends Model
{
    protected $guarded = [];

    public function products(): HasMany
    {
        return $this->hasMany(ProductInvoiceProduct::class);
    }

    public function inputProducts(): HasMany
    {
        return $this->hasMany(InputProduct::class);
    }

    public function outputProducts(): HasMany
    {
        return $this->hasMany(OutputProduct::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

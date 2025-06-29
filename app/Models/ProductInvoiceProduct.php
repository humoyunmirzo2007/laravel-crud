<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductInvoiceProduct extends Model
{
    protected $guarded = [];

    public function productInvoice(): BelongsTo
    {
        return $this->belongsTo(ProductInvoice::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

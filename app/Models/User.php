<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = [];

    protected $hidden = [
        "password",
    ];

    public function productInvoices(): HasMany
    {
        return $this->hasMany(ProductInvoice::class);
    }

    public function productInvoiceProducts(): HasMany
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

    protected function casts(): array
    {
        return [
            "password" => "hashed",
        ];
    }
}

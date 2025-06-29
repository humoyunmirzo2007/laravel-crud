<?php

use App\Enums\ProductInvoiceStatuses;
use App\Enums\ProductInvoiceTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->restrictOnDelete();
            $table->enum('type', array_column(ProductInvoiceTypes::cases(), 'value'));
            $table->enum('status', array_column(ProductInvoiceStatuses::cases(), 'value'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_invoices');
    }
};

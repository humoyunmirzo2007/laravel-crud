<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product_invoice_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained()->restrictOnDelete();
            $table->foreignId("product_id")->constrained()->restrictOnDelete();
            $table->foreignId("product_invoice_id")->constrained()->restrictOnDelete();
            $table->decimal("quantity", 10, 2);
            $table->dateTime("date");
            $table->unique(["product_id", "product_invoice_id"]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_invoice_products');
    }
};

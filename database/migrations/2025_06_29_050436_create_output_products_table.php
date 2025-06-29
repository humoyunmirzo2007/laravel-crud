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
        Schema::create('output_products', function (Blueprint $table) {
            $table->id();
            $table->decimal("quantity", 10, 1);
            $table->date("date");
            $table->foreignId("user_id")->constrained()->restrictOnDelete();
            $table->foreignId("product_id")->constrained()->restrictOnDelete();
            $table->foreignId("product_invoice_id")->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('output_products');
    }
};

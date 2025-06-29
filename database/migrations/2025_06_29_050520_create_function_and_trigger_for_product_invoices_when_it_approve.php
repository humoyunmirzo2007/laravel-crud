<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $function = File::get(database_path("sql/ProductInvoice/functions.sql"));
        DB::unprepared($function);

        $trigger = File::get(database_path("sql/ProductInvoice/triggers.sql"));
        DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trigger_insert_input_or_output_products ON product_invoices;");
        DB::unprepared("DROP FUNCTION IF EXISTS insert_input_or_output_product_when_product_invoice_approve();");
    }
};

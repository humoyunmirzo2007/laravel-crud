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
        $function = File::get(database_path("sql/OutputProduct/functions.sql"));
        DB::unprepared($function);

        $trigger = File::get(database_path("sql/OutputProduct/triggers.sql"));
        DB::unprepared($trigger);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS trigger_update_products_residue_when_output_product_create ON product_invoices;");
        DB::unprepared("DROP FUNCTION IF EXISTS update_products_residue_when_create_output_product();");
    }
};

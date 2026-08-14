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
        Schema::table('artificios', function (Blueprint $table) {
            $table->enum('tipo_restriccion', ['none', 'monthly', 'once'])->default('none');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artificios', function (Blueprint $table) {
            $table->dropColumn('tipo_restriccion');
        });
    }
};

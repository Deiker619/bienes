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
        //
        Schema::create('artificios', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Ente será FMJGH por defecto si no se envía valor
            $table->enum('ente', ['FMJGH', 'CONAPDIS'])->default('FMJGH')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('artificios');
    }
};

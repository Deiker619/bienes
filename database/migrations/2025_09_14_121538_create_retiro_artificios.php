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
        Schema::create('retiro_artificios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artificio_id');
            $table->unsignedBigInteger('retiro_id');
            $table->string('cantidad');
            $table->timestamps();

            // Relaciones
            $table->foreign('artificio_id')->references('id')->on('artificios')->onDelete('cascade');
            $table->foreign('retiro_id')->references('id')->on('retiros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retiro_artificios');
    }
};

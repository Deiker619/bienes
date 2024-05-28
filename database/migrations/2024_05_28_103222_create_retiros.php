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
        Schema::create('retiros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artificio_id');
            $table->integer('cantidad_retirada');
            $table->unsignedBigInteger('lugar_destino');
            $table->timestamps();

            $table->foreign('artificio')->references('id')->on('artificios')->onDelete('cascade');
            $table->foreign('lugar_destino')->references('id')->on('coordinacions')->onDelete('cascade');
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('retiros');
    }
};

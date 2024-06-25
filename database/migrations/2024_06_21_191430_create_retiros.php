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
            $table->unsignedBigInteger('lugar_destino')->nullable();
            $table->unsignedBigInteger('beneficiario_id')->nullable();
            $table->unsignedBigInteger('jornada_id')->nullable();
            $table->unsignedBigInteger('ente_id')->nullable();
            $table->timestamps();

            $table->foreign('artificio_id')->references('id')->on('artificios')->onDelete('cascade');
            $table->foreign('lugar_destino')->references('id')->on('coordinacions')->onDelete('cascade');
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
            $table->foreign('jornada_id')->references('id')->on('jornadas')->onDelete('cascade');
            $table->foreign('ente_id')->references('id')->on('entes')->onDelete('cascade');
            
            
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

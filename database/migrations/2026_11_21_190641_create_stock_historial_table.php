<?php
/* Migracion para crear la tabla stock_historial */
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
        Schema::create('stock_historial', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('artificio_id');
            $table->integer('cantidad');
            $table->timestamps();

            $table->foreign('artificio_id')->references('id')->on('artificios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_historial');
    }
};

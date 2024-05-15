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
        Schema::create('stock', function (Blueprint $table) {
            $table->id();
            $table->string('artificio');
            $table->integer('cantidad_artificio');
            $table->timestamp('created_at')->nullable();
            $table->string('ip_address', 45)->nullable();
            
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('stock');
    }
};

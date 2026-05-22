<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('retiros', function (Blueprint $table) {
            if (!Schema::hasColumn('retiros', 'is_reserva')) {
                $table->boolean('is_reserva')->default(false)->after('cedula_entrega');
            }
            if (!Schema::hasColumn('retiros', 'scheduled_at')) {
                $table->dateTime('scheduled_at')->nullable()->after('is_reserva');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('retiros', function (Blueprint $table) {
            if (Schema::hasColumn('retiros', 'scheduled_at')) {
                $table->dropColumn('scheduled_at');
            }
            if (Schema::hasColumn('retiros', 'is_reserva')) {
                $table->dropColumn('is_reserva');
            }
        });
    }
};

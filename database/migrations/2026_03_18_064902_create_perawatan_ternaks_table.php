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
        Schema::create('perawatan_ternaks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal_tindakan');
            $table->string('id_ternak'); 
            $table->string('diagnosa');
            $table->string('obat');
            $table->decimal('dosis', 8, 2);
            $table->string('satuan_dosis');
            $table->text('catatan')->nullable();
            $table->timestamps();
            $table->foreign('id_ternak')->references('id_ternak')->on('ternaks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perawatan_ternaks');
    }
};
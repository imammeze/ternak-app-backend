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
        Schema::create('perpindahan_ternaks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal_tindakan');
            $table->string('id_ternak');
            $table->string('kandang_awal');
            $table->string('kandang_tujuan');
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
        Schema::dropIfExists('perpindahan_ternaks');
    }
};
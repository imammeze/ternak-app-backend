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
        Schema::create('kandangs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('kode_kandang')->unique(); 
            $table->string('nama_kandang'); 
            $table->integer('kapasitas')->default(0);
            $table->string('jenis')->default('Umum'); 
            $table->string('status')->default('Aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kandangs');
    }
};
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
        Schema::create('pengeluaran_susus', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->date('tanggal');
            $table->integer('susu_1l')->default(0);
            $table->integer('susu_250ml')->default(0);
            $table->string('kategori'); 
            $table->string('pembayaran')->nullable(); 
            $table->string('customer')->nullable();
            $table->decimal('total_liter', 8, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengeluaran_susus');
    }
};
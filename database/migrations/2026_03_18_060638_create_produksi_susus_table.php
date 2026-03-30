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
        Schema::create('produksi_susus', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->date('tanggal');
            
            $table->integer('pagi_1l')->default(0);
            $table->integer('pagi_250ml')->default(0);
            $table->integer('pagi_cempe_ml')->default(0);
            
            $table->integer('sore_1l')->default(0);
            $table->integer('sore_250ml')->default(0);
            $table->integer('sore_cempe_ml')->default(0);
            
            $table->decimal('total_liter', 8, 2)->default(0);
            $table->string('petugas')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produksi_susus');
    }
};
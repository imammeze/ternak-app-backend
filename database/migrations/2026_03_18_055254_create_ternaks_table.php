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
        Schema::create('ternaks', function (Blueprint $table) {
            $table->string('id_ternak')->primary(); 
            $table->string('nama_ternak');
            $table->string('jenis_ternak');
            $table->string('jenis_kelamin');
            $table->string('no_kandang')->nullable();
            $table->string('kepemilikan');
            $table->string('user_id')->nullable();
            $table->string('asal_usul');
            $table->unsignedBigInteger('harga_beli')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->decimal('berat_lahir', 5, 2)->nullable();
            $table->string('id_induk')->nullable();
            $table->string('id_pejantan')->nullable();
            $table->string('tipe_kelahiran')->nullable();
            $table->string('foto')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ternaks');
    }
};
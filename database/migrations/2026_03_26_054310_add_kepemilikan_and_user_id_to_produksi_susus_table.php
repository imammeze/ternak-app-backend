<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('produksi_susus', function (Blueprint $table) {
            $table->string('kepemilikan')->default('Milik Sendiri')->after('tanggal');
            $table->uuid('user_id')->nullable()->after('kepemilikan');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produksi_susus', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['kepemilikan', 'user_id']);
        });
    }
};
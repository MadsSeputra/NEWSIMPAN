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
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_userlog');
            $table->unsignedBigInteger('id_dbsarana');
            $table->string('jumlah');
            $table->date('tanggal_pinjam');
            $table->date('tanggal_kembali');
            $table->string('keterangan');
            $table->string('status');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_userlog')->references('id')->on('user_logs')->onDelete('cascade');
            $table->foreign('id_dbsarana')->references('id')->on('dbsaranas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};

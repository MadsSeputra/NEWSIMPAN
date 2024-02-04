<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('dbsaranas', function (Blueprint $table) {
            $table->id();
            $table->string('id_sarana');
            $table->string('nama_sarana');
            $table->integer('jumlah_sarana');
            // $table->string('foto_sarana')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('dbsaranas');
    }
};

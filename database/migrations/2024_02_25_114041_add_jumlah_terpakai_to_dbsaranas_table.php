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
        Schema::table('dbsaranas', function (Blueprint $table) {
            $table->string('jumlah_terpakai')->after('jumlah_sarana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jumlah_terpakai', function (Blueprint $table) {
            //
        });
    }
};

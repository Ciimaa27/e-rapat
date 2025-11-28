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
        Schema::create('rapats', function (Blueprint $table) {
            $table->id();
            $table->string('judul_rapat');
            $table->date('tanggal');
            $table->time('jam');
            $table->string('ruangan'); // agenda diganti ruangan
            $table->string('prioritas')->default('Normal');
            $table->string('status')->default('Terjadwal');
            $table->unsignedBigInteger('notulis_id')->nullable();
            $table->unsignedBigInteger('dibuat_oleh')->nullable();
            $table->timestamps();

            $table->foreign('dibuat_oleh')->references('id')->on('users')->nullOnDelete();
            $table->foreign('notulis_id')->references('id')->on('users')->nullOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapats');
    }
};

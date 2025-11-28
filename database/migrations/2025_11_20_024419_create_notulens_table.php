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
        Schema::create('notulens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rapat_id')->nullable();
            $table->unsignedBigInteger('notulis_id')->nullable();
            $table->string('judul_rapat');
            $table->date('tanggal')->nullable();
            $table->time('jam')->nullable();
            $table->text('topik')->nullable();
            $table->string('status')->default('Direview'); 
            $table->string('file')->nullable(); // pdf
            $table->timestamps();

            $table->foreign('rapat_id')->references('id')->on('rapats')->cascadeOnDelete();
            $table->foreign('notulis_id')->references('id')->on('users')->nullOnDelete();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notulens');
    }
};

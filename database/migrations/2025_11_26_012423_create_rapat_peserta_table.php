<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rapat_peserta', function (Blueprint $table) {
            $table->id();

            // karena nama tabelmu "rapats"
            $table->foreignId('rapat_id')
                  ->constrained('rapats')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rapat_peserta');
    }
};

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
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('nik', 16);
            $table->enum('gender', ['Male', 'famale']);
            $table->date('birth_date');
            $table->string('birth_place', 100);
            $table->text('address');
            $table->string('religion', 50)->nullable();
            $table->enum('marital_status', ['Single', 'Married', 'Widowed', 'Divorced']);
            $table->string('occupation', 100)->nullable();
            $table->string('phone', 15)->nullable();
            $table->enum('status', ['Active', 'Moved', 'Deceased'])->default('Active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};

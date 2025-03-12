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
        Schema::create('bmi_calculators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']); // Jenis Kelamin
            $table->float('weight'); // Berat badan (kg)
            $table->float('height'); // Tinggi badan (cm)
            $table->float('bmi'); // Nilai BMI
            $table->string('category'); // Kategori BMI
            $table->float('ideal_weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_m_i_calculators');
    }
};

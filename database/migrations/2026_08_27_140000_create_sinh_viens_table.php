<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sinh_viens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ho_ten');
            $table->string('email');
            $table->string('nganh');
            $table->string('phone_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sinh_viens');
    }
};

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
        Schema::create('lop_hocs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ten_lop');
            $table->string('ma_lop');
            $table->string('giao_vien');
            $table->string('so_dien_thoai');
            $table->text('ghi_chu')->nullable();
            $table->integer('si_so')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lop_hocs');
    }
};

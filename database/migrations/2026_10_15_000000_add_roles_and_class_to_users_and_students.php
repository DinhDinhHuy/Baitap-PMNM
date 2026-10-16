<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('lecturer')->after('password');
        });

        Schema::table('sinh_viens', function (Blueprint $table) {
            $table->foreignId('lop_hoc_id')->nullable()->after('id')->constrained('lop_hocs')->nullOnDelete();
            $table->unique('email');
        });
    }

    public function down(): void
    {
        Schema::table('sinh_viens', function (Blueprint $table) {
            $table->dropUnique(['email']);
            $table->dropConstrainedForeignId('lop_hoc_id');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};

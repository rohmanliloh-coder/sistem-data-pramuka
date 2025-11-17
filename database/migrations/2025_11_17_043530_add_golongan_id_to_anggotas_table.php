<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('anggotas') && ! Schema::hasColumn('anggotas', 'golongan_id')) {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->foreignId('golongan_id')->nullable()->constrained('golongans')->onDelete('set null')->after('id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('anggotas') && Schema::hasColumn('anggotas', 'golongan_id')) {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->dropForeign(['golongan_id']);
                $table->dropColumn('golongan_id');
            });
        }
    }
};

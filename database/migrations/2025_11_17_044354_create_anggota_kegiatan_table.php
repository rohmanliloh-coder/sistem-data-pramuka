<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('anggota_kegiatan')) {
            Schema::create('anggota_kegiatan', function (Blueprint $table) {
                $table->id();
                $table->foreignId('anggota_id')->constrained('anggotas')->onDelete('cascade');
                $table->foreignId('kegiatan_id')->constrained('kegiatans')->onDelete('cascade');
                $table->string('peran')->nullable();
                $table->timestamps();
                $table->unique(['anggota_id','kegiatan_id'],'anggota_kegiatan_unique');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota_kegiatan');
    }
};

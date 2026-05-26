<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_studi_id')->constrained('program_studi')->onDelete('cascade');
            $table->string('nama');
            $table->string('nim')->unique();
            $table->string('email')->nullable()->unique();
            $table->string('no_hp')->nullable();
            $table->integer('angkatan');
            $table->enum('status', ['Aktif', 'Cuti', 'Lulus', 'Keluar'])->default('Aktif');
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};

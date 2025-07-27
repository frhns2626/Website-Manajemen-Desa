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
        Schema::create('penduduks', function (Blueprint $table) {
            $table->id();
            $table->string('nik', 16);
            $table->string('kk', 16);
            $table->string('name', 255);
            $table->enum('jenis_kelamin', ['Laki-Laki','Perempuan']);
            $table->string('tempat_lahir', 100);
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('agama', 50);
            $table->enum('status_perkawinan', ['belum kawin','kawin', 'cerai hidup', 'cerai mati']);
            $table->string('pekerjaan', 100);
            $table->string('pendidikan', 50);
            $table->enum('status_tinggal', ['tetap','pendatang', 'pindah', 'meninggal'])->default('tetap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penduduks');
    }
};

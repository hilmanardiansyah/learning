<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absens', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('jadwal_id');
            $table->foreignId('dosen_id')->nullable();
            $table->foreignId('mahasiswa_id')->nullable();
            $table->string('parent')->default(0);
            $table->boolean('status')->nullable();
            $table->string('pertemuan')->nullable();
            $table->text('rangkuman')->nullable();
            $table->text('berita_acara')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('absens');
    }
};

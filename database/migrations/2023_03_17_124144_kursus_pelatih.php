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
        Schema::create('kursuspelatih', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idPelatih');
            $table->foreignId('idKota');
            $table->foreignId('idKategori');
            $table->text('deskripsi');
            $table->integer('harga');
            $table->integer('sesi');
            $table->string('target');
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
        Schema::dropIfExists('kursusPelatih');
    }
};

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
        Schema::create('lapangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idKategori');
            $table->foreignId('idKota');
            $table->foreignId('idOwner');
            $table->string('namaLapangan');
            $table->string('lokasi');
            $table->string('deskripsi');
            $table->integer('harga');
            $table->string('gambar');
            $table->integer('jamBuka');
            $table->integer('jamTutup');
            $table->integer('statusToko');
            $table->integer('nomor');
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
        Schema::dropIfExists('lapangan');
    }
};

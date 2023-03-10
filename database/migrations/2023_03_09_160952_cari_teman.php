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
        Schema::create('cariTeman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('idOwner');
            $table->foreignId('idKota');
            $table->foreignId('idKategori');
            $table->date('tanggalMain');
            $table->integer('jam');
            $table->text('deskripsi');
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
        Schema::dropIfExists('cariTeman');
    }
};

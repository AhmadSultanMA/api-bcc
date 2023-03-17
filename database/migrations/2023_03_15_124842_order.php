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
        Schema::create('order', function (Blueprint $table) {
            $table->id();
            $table->text('order_id')->unique();
            $table->foreignId('idOwner');
            $table->foreignId('idLapangan');
            $table->foreignId('idAlat')->nullable();
            $table->integer('jmlJam');
            $table->integer('jamMulai');
            $table->integer('jamSelesai');
            $table->bigInteger('harga');
            $table->date('tanggalBooking');
            $table->integer('status');
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
        Schema::dropIfExists('order');
    }
};

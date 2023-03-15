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
            $table->foreignId('idOwner');
            $table->foreignId('idLapangan');
            $table->foreignId('idAlat')->nullable();
            $table->integer('jmlJam');
            $table->integer('jamMulai');
            $table->integer('jamSelesai');
            $table->bigInteger('harga');
            $table->date('tanggalBooking');
            $table->enum('status',['Unpaid','Paid']);
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

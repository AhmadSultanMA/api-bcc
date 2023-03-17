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
        Schema::create('orderkursus', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('idOwner');
            $table->foreignId('idKursus');
            $table->integer('jmlBulan');
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
        Schema::dropIfExists('orderkursus');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('invoice')->unsigned();
            $table->integer('midtrans_order_id')->nullable();
            $table->integer('user_id');
            $table->date('reservation_date');
            $table->string('reservation_time');
            $table->string('status');
            $table->bigInteger('total');
            $table->string('proof');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}

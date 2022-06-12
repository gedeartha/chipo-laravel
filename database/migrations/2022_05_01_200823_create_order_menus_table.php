<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice');
            $table->integer('menu_id')->unsigned();
            $table->integer('menu');
            $table->bigInteger('menu_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_menus');
    }
}

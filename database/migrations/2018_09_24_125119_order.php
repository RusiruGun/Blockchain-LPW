<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Order extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('o_id');
            $table->string('o_po');
            $table->string('0_p_name');
            $table->string('o_p_length');
            $table->string('o_p_width');
            $table->string('o_p_thikness');
            $table->string('o_p_doorskin');
            $table->string('o_p_type');
            $table->string('o_p_qty');
            $table->string('o_p_note');
            $table->string('o_d_add1');
            $table->string('o_d_add2');
            $table->string('o_d_city');
            $table->string('o_d_date');
            $table->string('o_state');
            $table->string('o_production_qty');
            $table->string('o_stock_qty');
            $table->string('o_dilivery_qty');
            $table->string('o_production_date');
            $table->string('o_stock_date');
            $table->string('o_delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_orders');
    }
}

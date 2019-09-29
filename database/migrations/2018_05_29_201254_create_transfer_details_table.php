<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransferDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfer_details', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');
            $table->integer('order_id')->unsigned();
            $table->string('acount_owner_name');
            $table->string('bank_user_number');
            $table->string('dealer_bank_number');
            $table->string('total_transfer_maney');
            $table->string('transfer_image');
            $table->string('bank_name');
            $table->string('pay_notes');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transfer_details');
    }
}

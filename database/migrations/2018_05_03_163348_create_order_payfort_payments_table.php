<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderPayfortPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payfort_payments', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('access_code') ;
            $table->string('merchant_reference') ;
            $table->string('currency') ;
            $table->string('language') ;
            $table->string('cutomer_email') ;
            $table->string('signature') ;
            $table->string('payment_option') ;
            $table->string('saded_olp') ;
            $table->string('oci') ;
            $table->string('order_decription') ;
            $table->string('cstomer_ip') ;
            $table->string('customer_name') ;
            $table->string('authorization_code') ;
            $table->string('response_message') ;
            $table->string('response_code') ;
            $table->string('status') ;
            $table->string('expiry_date') ;
            $table->string('cart_number') ;
            $table->integer('fort_id') ;
            $table->integer('amount') ;
            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('order_payfort_payments');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('product_owner')->references('id')->on('users')->onDelete('cascade');
            $table->integer('product_owner')->unsigned();
            $table->foreign('addresse_id')->references('id')->on('users_addresses')->onDelete('cascade');
            $table->integer('addresse_id')->unsigned();
            $table->integer('parent_id')->default(0);
            $table->string('total')->default(0);
            $table->string('tax')->default(0);
            $table->string('tax_percentage')->default(0);
            $table->string('discount')->default(0);
            $table->text('order_note')->nullable();
            $table->enum('payment_type',['transfer_bank','oncash'])->default('oncash');
            $table->enum('order_status',[ 'in_progress','in_prepration','on_delevery','delevried','cancelled' , 'refunded'])->default('in_progress');
            $table->float('shiping_price')->default(1);
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
        Schema::dropIfExists('orders');
    }
}

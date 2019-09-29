<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hits');
            $table->string('ip');
            $table->date('date');
            $table->integer('month');
            $table->integer('product_id')->defaut(0);
            $table->integer('user_id')->defaut(0);
            $table->time('visit_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_views');
    }
}

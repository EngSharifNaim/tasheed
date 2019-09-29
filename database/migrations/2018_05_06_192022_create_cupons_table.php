<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCuponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupons', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('cupon_code');
            $table->string('start_date') ;
            $table->string('end_date') ;
            $table->float('min_price') ;
            $table->float('max_price') ;
            $table->integer('user_id')->nullable();
            $table->integer('currencie_id')->nullable();
            $table->integer('countrie_id')->nullable();
            $table->integer('citie_id')->nullable();
            $table->integer('region_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->integer('discount_monay')->nullable();
            $table->enum('active',['yes','no'])->default('no');
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
        Schema::dropIfExists('cupons');
    }
}

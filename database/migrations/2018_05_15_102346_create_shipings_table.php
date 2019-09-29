<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipings', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB' ;
            $table->increments('id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned();
           // $table->foreign('countrie_id')->references('id')->on('countries');
            $table->integer('countrie_id')->default(0);
           // $table->foreign('citie_id')->references('id')->on('cities');
            $table->integer('citie_id')->default(0);
            $table->integer('shiping_coast');
            $table->integer('h_w_for_shiping_coast');
            $table->integer('coast_per_k_after_h_w');
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
        Schema::dropIfExists('shipings');
    }
}

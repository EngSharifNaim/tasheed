<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_addresses', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('countrie_id')->references('id')->on('countries')->onDelete('cascade');
            $table->integer('countrie_id')->unsigned();
            $table->foreign('citie_id')->references('id')->on('cities')->onDelete('cascade');
            $table->integer('citie_id')->unsigned();
            $table->integer('region_id')->default(0);
            $table->string('addresse_ar');
            $table->string('addresse_en')->nullable();
            $table->string('restrict_name_ar')->nullable();
            $table->string('restrict_name_en')->nullable();
            $table->string('mail_number')->nullable();
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
        Schema::dropIfExists('users_addresses');
    }
}

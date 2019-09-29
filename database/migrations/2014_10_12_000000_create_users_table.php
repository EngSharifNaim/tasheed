<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('photo');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('addresse');
            $table->string('zip_code');
            $table->string('street_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('active',['yes','no'])->default('no');
            $table->enum('level',['admin','user','dealer'])->default('user');
            $table->integer('countrie_id')->unsigned();
            $table->integer('citie_id')->unsigned();
            $table->integer('region_id')->unsigned();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

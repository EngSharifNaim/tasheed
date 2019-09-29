<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name_ar' ) ;
            $table->string('name_en' )->nullable() ;
            $table->string('phone' ) ;
            $table->string('email' ) ;
            $table->string('tax_number' )->nullable() ;
            $table->string('commercial_register' )->nullable() ;
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('user_id')->unsigned();
            $table->integer('acount_bank_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('company_website')->nullable();
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
        Schema::dropIfExists('companies');
    }
}

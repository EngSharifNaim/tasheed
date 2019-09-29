<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('name_ar')->unique()->default('page');
            $table->string('name_en')->unique()->default('page');
            $table->string('url')->nullable();
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->enum('active',['yes','no'])->default('no');
            $table->enum('page_location',['top_bar','menu' , 'footer'])->default('footer');
            $table->integer('sorting')->nullable() ;
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
        Schema::dropIfExists('pages');
    }
}

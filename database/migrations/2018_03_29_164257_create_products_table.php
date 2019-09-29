<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_ar');
            $table->string('name_en');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->string('keywords_ar')->nullable();
            $table->string('keywords_en')->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('section_id')->references('id')->on('sections');
            $table->integer('section_id')->unsigned();
            $table->foreign('sub_section_id')->references('id')->on('sections');
            $table->integer('sub_section_id')->unsigned()->nullable();
            $table->foreign('sub_sub_section_id')->references('id')->on('sections');
            $table->integer('sub_sub_section_id')->unsigned()->nullable();
            $table->foreign('product_owner_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('product_owner_id')->unsigned();
            $table->foreign('color_id')->references('id')->on('colors');
            $table->string('color_id')->nullable();
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->string('size_id')->nullable();
            $table->string('weight')->nullable();
            $table->string('image')->nullable();
            $table->longText('images')->nullable();
            $table->integer('manfacture_country')->unsgined()->default(0);
            $table->integer('measurements_unit_id')->unsgined()->default(0);
            $table->text('details_ar')->nullable();
            $table->text('details_en')->nullable();
            $table->integer('price');
            $table->integer('min_price')->nullable();
            $table->integer('views')->nullable();
            $table->integer('quantity')->nullable();
            $table->integer('min_quantity')->nullable();
            $table->integer('max_quantity')->nullable();
            $table->enum('active',['yes','no'])->default('no');
            $table->enum('featured',['yes','no'])->default('no');
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
        Schema::dropIfExists('products');
    }
}

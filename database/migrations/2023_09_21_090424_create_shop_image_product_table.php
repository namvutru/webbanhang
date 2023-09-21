<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopImageProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_image_product', function (Blueprint $table) {
            $table->id();
            $table->string('title',255);
            $table->string('description',255);
            $table->integer('status')->default(1);
            $table->integer('type')->default(1);
            $table->string('image',255);
            $table->foreignId('shop_product_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_image_product');
    }
}

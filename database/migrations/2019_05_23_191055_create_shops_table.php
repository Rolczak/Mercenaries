<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->timestamp('update_time')->nullable();
            $table->timestamps();
        });

        Schema::table('shops', function (Blueprint $table){
           $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('item_shop', function (Blueprint $table){
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('shop_id');
            $table->primary(['item_id', 'shop_id']);
        });

        Schema::table('item_shop', function (Blueprint $table){
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('shop_id')->references('id')->on('shops');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
        Schema::dropIfExists('item_shop');
    }
}

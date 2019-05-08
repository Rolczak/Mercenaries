<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_stat', function (Blueprint $table) {
            $table->unsignedBigInteger('stat_id');
            $table->unsignedBigInteger('item_id');
            $table->integer('value');
        });
        Schema::table('item_stat', function (Blueprint $table) {
            $table->foreign('stat_id')->references('id')->on('stats');
            $table->foreign('item_id')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_stat');
    }
}

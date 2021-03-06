<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stat_user', function (Blueprint $table) {
            $table->unsignedBigInteger('stat_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('value')->default(1);
            $table->primary(['stat_id', 'user_id']);

        });
        Schema::table('stat_user', function (Blueprint $table){
            $table->foreign('stat_id')->references('id')->on('stats');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stat_user');
    }
}

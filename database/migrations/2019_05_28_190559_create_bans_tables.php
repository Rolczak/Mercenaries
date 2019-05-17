<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('reason');
            $table->unsignedBigInteger('giver_id');
            $table->timestamp('expired')->nullable();
            $table->tinyInteger('removed')->default(0);
            $table->timestamps();
        });
        Schema::table('bans', function (Blueprint $table) {
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('giver_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bans_tables');
    }
}

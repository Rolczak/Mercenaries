<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description');
            $table->float('time');
            $table->float('energy');
            $table->string('image_path');
            $table->integer('credits');
            $table->integer('exp');
            $table->timestamps();
        });

        Schema::create('quest_user', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('quest_id');
        });
        Schema::table('quest_user', function (Blueprint $table){
           $table->foreign('user_id')->references('id')->on('users');
           $table->foreign('quest_id')->references('id')->on('quests');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quests');
        Schema::dropIfExists('quest_user');
    }
}

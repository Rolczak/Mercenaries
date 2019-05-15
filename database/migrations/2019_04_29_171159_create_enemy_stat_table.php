<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnemyStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enemy_stat', function (Blueprint $table) {
            $table->unsignedBigInteger('stat_id');
            $table->unsignedBigInteger('enemy_id');
            $table->integer('value');
            $table->primary(['stat_id', 'enemy_id']);
        });

        Schema::table('enemy_stat', function (Blueprint $table) {
            $table->foreign('stat_id')->references('id')->on('stats');
            $table->foreign('enemy_id')->references('id')->on('enemies');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enemy_stat');
    }
}

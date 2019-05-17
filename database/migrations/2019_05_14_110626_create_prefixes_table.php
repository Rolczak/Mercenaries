<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefixes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('level');
            $table->string('color');
            $table->enum('type',['weapon','armor']);
            $table->timestamps();
        });

        Schema::create('prefix_stat', function (Blueprint $table) {
            $table->unsignedBigInteger('stat_id');
            $table->unsignedBigInteger('prefix_id');
            $table->integer('value');
            $table->primary(['stat_id', 'prefix_id']);
        });
        Schema::table('prefix_stat', function (Blueprint $table) {
            $table->foreign('stat_id')->references('id')->on('stats');
            $table->foreign('prefix_id')->references('id')->on('prefixes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prefixes');
        Schema::dropIfExists('prefix_stat');
    }
}

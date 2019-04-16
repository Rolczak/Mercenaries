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
            $table->bigInteger('stat_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->integer('value')->default(1);
            $table->primary(['stat_id', 'user_id']);
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

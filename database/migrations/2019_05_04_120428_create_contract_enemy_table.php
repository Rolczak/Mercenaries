<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractEnemyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_enemy', function (Blueprint $table) {
            $table->unsignedBigInteger('contract_id');
            $table->unsignedBigInteger('enemy_id');
            $table->primary(['contract_id', 'enemy_id']);
        });

        Schema::table('contract_enemy', function (Blueprint $table)
        {
           $table->foreign('contract_id')->references('id')->on('contracts');
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
        Schema::table('contract_enemy', function (Blueprint $table) {
            //
        });
    }
}

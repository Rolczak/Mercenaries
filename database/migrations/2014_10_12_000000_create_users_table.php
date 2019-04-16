<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('credits')->default(100);
            $table->integer('uranium')->default(0);
            $table->integer('actionpoints')->default(50);
            $table->integer('role_id')->default(1)->unsigned();
            $table->timestamp('lastenergyupdate')->default(Carbon::now()->toDateTimeString());
            $table->integer('experience')->default(0);
            $table->integer('level')->unsigned()->default(1);
            $table->double('hp')->unsigned()->default(100);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}

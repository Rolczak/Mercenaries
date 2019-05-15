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
            $table->integer('action_points')->default(50);
            $table->unsignedInteger('role_id')->default(1);
            $table->timestamp('last_energy_update')->default(Carbon::now()->toDateTimeString());
            $table->timestamp('last_health_update')->default(Carbon::now()->toDateTimeString());
            $table->timestamp('finish_job')->default(Carbon::now());
            $table->integer('experience')->default(0);
            $table->integer('level')->unsigned()->default(1);
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

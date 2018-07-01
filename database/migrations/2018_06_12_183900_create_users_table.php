<?php

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
          $table->uuid('uuid')->unique();
          $table->string('firstname');
          $table->string('lastname');
          $table->string('email')->unique();
          $table->string('hashed_password');
          $table->string('dob');
          $table->boolean('gender');
          $table->integer('street_number')->default(0);
          $table->string('route')->default('');
          $table->string('city')->default('');
          $table->string('state')->default('');
          $table->integer('zip_code')->default(0);
          $table->string('country')->default('');
          $table->string('cover_image')->default('');
          $table->string('avatar')->default('');
          $table->boolean('democrat')->default(0);
          $table->boolean('republican')->default(0);
          $table->boolean('liberal')->default(0);
          $table->integer('setup_stage')->default(0);
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

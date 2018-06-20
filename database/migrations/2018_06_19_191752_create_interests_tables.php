<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('interests', function (Blueprint $table) {
        $table->string('uuid')->unique();
        $table->string('sports');
        $table->string('food');
        $table->string('entertainment');
        $table->string('technology');
        $table->string('politics');
        $table->string('religion');
        $table->string('education');
        $table->string('philosophy');
        $table->string('art');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('interests');
    }
}

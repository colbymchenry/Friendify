<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Photos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('photos', function (Blueprint $table) {
        $table->increments('id')->unique();
        $table->string('name');
        $table->uuid('owner');
        $table->integer('server_id');
        $table->string('description')->nullable()->default('');
        $table->string('tagged_people')->nullable()->default('');
        $table->integer('likes')->default(0);
        $table->string('comments')->nullable()->default('');
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
        Schema::dropIfExists('photos');
    }
}

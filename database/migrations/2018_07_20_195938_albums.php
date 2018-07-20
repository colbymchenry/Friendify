<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Albums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('albums', function (Blueprint $table) {
         $table->increments('id')->unique();
         $table->uuid('owner');
         $table->string('name')->default('');
         $table->string('photos')->default('');
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
         Schema::dropIfExists('albums');
     }
}

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
        $json = json_decode(\Storage::get('Interests.json'), true);

        function add($table, $prefix, $data) {
          foreach ($data as $key => $value) {
            if (is_array($value)) {
              if ($prefix != '') {
                $table->boolean($prefix . '_' . $key)->default(0);
              } else {
                $table->boolean($key)->default(0);
              }
              if ($prefix != '') {
                add($table, $prefix . '_' . $key, $value);
              } else {
                add($table, $key, $value);
              }
            } else {
              if ($prefix != '') {
                $table->boolean($prefix . '_' . $value)->default(0);
              } else {
                $table->boolean($value)->default(0);
              }
            }
          }
        }

        add($table, '' , $json);

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

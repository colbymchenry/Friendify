<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InterestUpdate2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('interests', function (Blueprint $table) {
          $json = json_decode(\Storage::get('Interests.json'), true);

          function add($table, $prefix, $data) {
            foreach ($data as $key => $value) {
              if (is_array($value)) {
                if ($prefix != '') {
                  if(!Schema::hasColumn('interests', $prefix . '_' . $key)) {
                    $table->boolean($prefix . '_' . $key)->default(0);
                  }
                } else {
                  if(!Schema::hasColumn('interests', $key)) {
                    $table->boolean($key)->default(0);
                  }
                }
                if ($prefix != '') {
                  add($table, $prefix . '_' . $key, $value);
                } else {
                  add($table, $key, $value);
                }
              } else {
                if ($prefix != '') {
                  if(!Schema::hasColumn('interests', $prefix . '_' . $value)) {
                    $table->boolean($prefix . '_' . $value)->default(0);
                  }
                } else {
                  if(!Schema::hasColumn('interests', $value)) {
                    $table->boolean($value)->default(0);
                  }
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

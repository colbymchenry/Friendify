<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTables extends Migration
{
   /* ===== IF WE NEED TO UPDATE WE HAVE TO DO THIS EVERY TIME =====
    * You create another migration to alter tables.
    * So when you first make the table, you'll create all the fields etc.
    * If you want to add another column, or change a column then you create a NEW migration. If you just edit the old one then running php artisan migrate wont do anything.
    */

    /*
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

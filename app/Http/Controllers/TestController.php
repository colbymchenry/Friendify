<?php

namespace App\Http\Controllers;

class TestController extends Controller {

  function index() {

    $seth = new \App\User(\DB::table('users')->where('firstname', 'Seth')->first()->uuid);
    $colby = new \App\User(\DB::table('users')->where('firstname', 'Colby')->first()->uuid);

    $score = $seth->match_score_with($colby);

    return \View::make('test')->with('data', ["Score: $score"]);

  }

}

?>

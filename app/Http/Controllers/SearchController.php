<?php

namespace App\Http\Controllers;

class SearchController extends Controller {

  function search_people() {

    $profile = '';

    return \View::make('search_people')->with('profile', $profile);

  }

}

<?php

namespace App\Http\Controllers;

class TestController extends Controller {

  function index() {

    $data = 'Hello, World!';

    return \View::make('test')->with('data', $data);

  }

}

?>

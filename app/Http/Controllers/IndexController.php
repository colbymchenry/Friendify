<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{

  function index()
  {
    $profile = array();
    return \View::make("profile")->with("profile", $profile);
  }

}

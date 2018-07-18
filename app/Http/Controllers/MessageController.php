<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Messages;
use \Session;
use \View;

class MessageController extends Controller {

  function index() {
    return View::make('messages')
    ->with('profile', User::where('uuid', Session::get('uuid'))->first())
    ->with('title', 'Messages')
    ->with('conversations', explode(';', Messages::where('uuid', Session::get('uuid'))->first()->message_history));
  }

}

?>

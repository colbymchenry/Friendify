<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  $uuid, $firstname, $lastname, $email, $hashed_password, $dob, $gender;

  function __construct($uuid)
  {
      $result = \DB::select("SELECT * FROM users WHERE uuid='$uuid'");

      if($result->next)
      {
          $firstname = $result->firstname;
          $lastname = $result->lastname;
          $email = $result->email;
          $hashed_password = $result->hashed_password;
          $dob = $result->dob;
          $gender = $result->gender;
      }
      else
      {
          throw new Exception("User was not found with that UUID.");
      }
  }

}

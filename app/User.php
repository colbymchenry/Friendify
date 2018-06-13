<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  public $uuid;
  public $firstname;
  public $lastname;
  public $email;
  public $hashed_password;
  public $dob;
  public $gender;

  function __construct($uuid)
  {
      $this->uuid = '';
      $this->firstname = '';
      $this->lastname = '';
      $this->email = '';
      $this->hashed_password = '';
      $this->dob = '';
      $this->gender = '';

      $result = \DB::table('users')->where('uuid', $uuid)->first();

      if(count($result) == 1)
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

  static function create($firstname, $lastname, $email, $hashed_password, $dob, $gender)
  {
    $result = \DB::table('users')->where('email', $email)->first();

    if (count($result) != 0)
    {
      \Log::error("Email already exists: $email");
    }
    else
    {
      \Log::info("New user added: $email");
      \DB::table('users')->insert(array(
      'uuid' => HTTP\Controllers\Utilities\UUID::random(),
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'hashed_password' => $hashed_password,
      'dob' => $dob,
      'gender' => $gender
      ));
    }

}

}

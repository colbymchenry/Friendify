<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  static public $MALE = 0;
  static public $FEMALE = 1;

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
          $this->firstname = $result->firstname;
          $this->lastname = $result->lastname;
          $this->email = $result->email;
          $this->hashed_password = $result->hashed_password;
          $this->dob = $result->dob;
          $this->gender = $result->gender;
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
      throw new \Exception("Email already exists.");
    }
    else
    {
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

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
  public $location;
  public $cover_image;
  public $avatar;
  public $interests;
  public $democrat;
  public $republican;
  public $liberal;

  function __construct($uuid)
  {
      $this->uuid = '';
      $this->firstname = '';
      $this->lastname = '';
      $this->email = '';
      $this->hashed_password = '';
      $this->dob = '';
      $this->gender = '';
      $this->location = '';
      $this->cover_image = 'https://i.imgur.com/A6J7EpN.png';
      $this->avatar = 'https://i.imgur.com/3gokj8j.png';
      $this->interests = array();
      $this->democrat = false;
      $this->republican = false;
      $this->liberal = false;

      $result = \DB::table('users')->where('uuid', $uuid)->first();

      if(count($result) != 0)
      {
          $this->firstname = $result->firstname;
          $this->lastname = $result->lastname;
          $this->email = $result->email;
          $this->hashed_password = $result->hashed_password;
          $this->dob = $result->dob;
          $this->gender = $result->gender;
          $this->location = $result->location;

          /*
          * BEGIN FILLING INTERESTS
          */
          $result_interests = \DB::table('interests')->where('uuid', $uuid)->first();

          if(count($result_interests) == 0)
          {
            throw new \Exception("User not found in interests table.");
          }

          $this->interests = array();

          foreach(\DB::getSchemaBuilder()->getColumnListing('interests') as $column)
          {

            if ($column != 'uuid') {
              $this->interests[$column] = $result_interests->$column;
            }

          }

          $this->democrat = $result->democrat;
          $this->republican = $result->republican;
          $this->liberal = $result->liberal;
      }
      else
      {
          throw new \Exception("User was not found with that UUID.");
      }
  }

  // $json = json_decode(file_get_contents($path), true);

  function to_array()
  {
    return array(
      'uuid' => $uuid,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'dob' => $dob,
      'gender' => $gender,
      'interests' => $interests,
      'democrat' => $democrat,
      'republican' => $republican,
      'liberal' => $liberal
    );
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

  function matchScoreWith($otherUser) {

    $first_interests = \DB::table('interests')->where('uuid', $this->uuid)->first();
    $second_interests = \DB::table('interests')->where('uuid', $otherUser->uuid)->first();



  }

}

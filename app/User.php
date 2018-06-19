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
  public $interests_top;
  public $interests_middle;
  public $interests_bottom;
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
      $this->interests_top = array();
      $this->interests_middle = array();
      $this->interests_bottom = array();
      $this->democrat = false;
      $this->republican = false;
      $this->liberal = false;

      $result = \DB::table('users')->where('uuid', $uuid)->first();

      if(count($result) != 0)
      {
          $firstname = $result->firstname;
          $lastname = $result->lastname;
          $email = $result->email;
          $hashed_password = $result->hashed_password;
          $dob = $result->dob;
          $gender = $result->gender;

          /*
          * BEGIN FILLING INTERESTS TOP
          */
          $result_interests_top = \DB::table('interests_top')->where('uuid', $uuid)->first();

          if(count($result) == 0)
          {
            throw new \Exception("User not found in interests_top table.");
          }

          foreach(\DB::getSchemaBuilder()->getColumnListing('interests_top') as $column)
          {
            $interests_top[$column] = $result_interests_top->$column;
          }

          /*
          * BEGIN FILLING INTERESTS MIDDLE
          */
          $result_interests_middle = \DB::table('interests_middle')->where('uuid', $uuid)->first();

          if(count($result) == 0)
          {
            throw new \Exception("User not found in interests_middle table.");
          }

          foreach(\DB::getSchemaBuilder()->getColumnListing('interests_middle') as $column)
          {
            $interests_middle[$column] = $result_interests_middle->$column;
          }

          /*
          * BEGIN FILLING INTERESTS BOTTOM
          */
          $result_interests_bottom = \DB::table('interests_bottom')->where('uuid', $uuid)->first();

          if(count($result) == 0)
          {
            throw new \Exception("User not found in interests_bottom table.");
          }

          foreach(\DB::getSchemaBuilder()->getColumnListing('interests_bottom') as $column)
          {
            $interests_bottom[$column] = $result_interests_bottom->$column;
          }

          $democrat = $result->democrat;
          $republican = $result->republican;
          $liberal = $result->liberal;
      }
      else
      {
          throw new \Exception("User was not found with that UUID.");
      }
  }

  function to_array()
  {
    return array(
      'uuid' => $uuid,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'dob' => $dob,
      'gender' => $gender,
      'interests_top' => $interests_top,
      'interests_middle' => $interests_middle,
      'interests_bottom' => $interests_bottom,
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

}

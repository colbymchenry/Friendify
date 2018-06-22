<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

  public $table = 'users';
  public $timestamps = true;
  protected $connection = 'mysql';
  protected $primaryKey = 'uuid';
  // static public $MALE = 0;
  // static public $FEMALE = 1;
  //
  // public $uuid;
  // public $firstname;
  // public $lastname;
  // public $email;
  // public $hashed_password;
  // public $dob;
  // public $gender;
  // public $location;
  // public $cover_image;
  // public $avatar;
  // public $interests;
  // public $democrat;
  // public $republican;
  // public $liberal;
  //
  // function __construct($uuid)
  // {
  //     $this->uuid = '';
  //     $this->firstname = '';
  //     $this->lastname = '';
  //     $this->email = '';
  //     $this->hashed_password = '';
  //     $this->dob = '';
  //     $this->gender = '';
  //     $this->location = '';
  //     $this->cover_image = 'https://i.imgur.com/A6J7EpN.png';
  //     $this->avatar = 'https://i.imgur.com/3gokj8j.png';
  //     $this->interests = array();
  //     $this->democrat = false;
  //     $this->republican = false;
  //     $this->liberal = false;
  //
  //     $result = \DB::table('users')->where('uuid', $uuid)->first();
  //
  //     if(count($result) != 0)
  //     {
  //         $this->uuid = $result->uuid;
  //         $this->firstname = $result->firstname;
  //         $this->lastname = $result->lastname;
  //         $this->email = $result->email;
  //         $this->hashed_password = $result->hashed_password;
  //         $this->dob = $result->dob;
  //         $this->gender = $result->gender;
  //         $this->location = $result->location;
  //
  //         /*
  //         * BEGIN FILLING INTERESTS
  //         */
  //         $result_interests = \DB::table('interests')->where('uuid', $uuid)->first();
  //
  //         if(count($result_interests) == 0)
  //         {
  //           throw new \Exception("User not found in interests table.");
  //         }
  //
  //         $this->interests = array();
  //
  //         foreach(\DB::getSchemaBuilder()->getColumnListing('interests') as $column)
  //         {
  //
  //           if ($column != 'uuid') {
  //             $this->interests[$column] = $result_interests->$column;
  //           }
  //
  //         }
  //
  //         $this->democrat = $result->democrat;
  //         $this->republican = $result->republican;
  //         $this->liberal = $result->liberal;
  //     }
  //     else
  //     {
  //         throw new \Exception("User was not found with that UUID.");
  //     }
  // }
  //
  // public function save()
  // {
  //   $update_array = $to_array();
  //   // unset($update_array, 'uuid');
  //   \DB::table('users')->where('uuid', $this->uuid)->update($update_array);
  // }
  //
  // // $json = json_decode(file_get_contents($path), true);
  //
  // public function to_array()
  // {
  //   return array(
  //     'uuid' => $this->uuid,
  //     'firstname' => $this->firstname,
  //     'lastname' => $this->lastname,
  //     'email' => $this->email,
  //     'dob' => $this->dob,
  //     'gender' => $this->gender,
  //     'interests' => $this->interests,
  //     'democrat' => $this->democrat,
  //     'republican' => $this->republican,
  //     'liberal' => $this->liberal,
  //     'cover_image' => $this->cover_image,
  //     'avatar' => $this->avatar,
  //     'location' => $this->location
  //   );
  // }

  static function create($firstname, $lastname, $email, $hashed_password, $dob, $gender)
  {
    $result = \DB::table('users')->where('email', $email)->first();

    if (count($result) != 0)
    {
      throw new \Exception("Email already exists.");
    }
    else
    {
      $uuid = HTTP\Controllers\Utilities\UUID::random();
      \DB::table('users')->insert(array(
      'uuid' => $uuid,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'hashed_password' => $hashed_password,
      'dob' => $dob,
      'gender' => $gender
      ));
      \DB::table('interests')->insert(array('uuid' => $uuid));
      return $uuid;
    }

  }

  function match_score_with($other_user) {
    $first = (array) \DB::table('interests')->where('uuid', $this->uuid)->first();
    $second = (array) \DB::table('interests')->where('uuid', $other_user->uuid)->first();
    $sum = 0;
    foreach ($first as $key => $value) {
      if ($key != 'uuid') {
        $sum = $sum + $value * $second[$key];
      }
    }
    return $sum;
  }

}

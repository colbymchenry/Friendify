<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use HTTP\Controllers\Utilities\UUID;

class User extends Model
{

  public $table = 'users';
  public $timestamps = true;
  protected $connection = 'mysql';
  protected $primaryKey = 'uuid';
  public $incrementing = false;
  public $fillable = array('firstname', 'middlename', 'lastname', 'email', 'phonenumber');

  static function create($firstname, $lastname, $email, $hashed_password, $dob, $gender)
  {
    $result = \DB::table('users')->where('email', $email)->first();

    if (count($result) != 0)
    {
      throw new \Exception("Email already exists.");
    }
    else
    {
      $uuid = UUID::random();
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
      \DB::table('profiles')->insert(array('uuid' => $uuid));
      \DB::table('friends')->insert(array('uuid' => $uuid));
      return $uuid;
    }

  }

  function match_score_with($other_user) {
    $first = (array) \DB::table('interests')->where('uuid', $this->uuid)->get()->first();
    $second = (array) \DB::table('interests')->where('uuid', $other_user['uuid'])->get()->first();
    $sum = 0;
    $keys = array_keys($second);
    foreach ($keys as $key) {
      if ($key != 'uuid') {
        $test = $first[$key];
        $test2 = $second[$key];
        $sum = $sum + $first[$key] * $second[$key];
      }
    }
    return $sum;
  }

}

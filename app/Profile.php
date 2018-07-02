<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Profile as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

  public $table = 'profiles';
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey = 'uuid';
  public $incrementing = false;

  static function amend($uuid, $about)
  {
    $result = \DB::table('profiles')->where('uuid', $uuid);

    if (count($result) == 0)
    {
      throw new \Exception("Profile does not exist.");
    }
    else if (count($result) == 1) {
      \DB::table('profiles')->where('uuid', $uuid)->update(array('about' => $about));
    } else {
      throw new \Exception("Duplicate Profiles.");
    }

  }

}

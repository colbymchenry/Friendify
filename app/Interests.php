<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Interests extends Model
{

  public $table = 'interests';
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey = 'uuid';
  public $incrementing = false;

/**
* TOOK FOREVER TO GET THIS TO WORK RECURSIVELY, DON'T FUCK WITH THIS PLEASE.
**/
  public static function getInterests()
  {
    global $interests;
    $interests = array();
    $json = json_decode(\Storage::get('Interests.json'), true);

    Interests::addInterests('' , $json, $interests);
    return $interests;
  }

  static function addInterests($prefix, $data) {
    global $interests;
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        if ($prefix != '') {
          array_push($interests, $prefix . '_' . $key);
        } else {
          array_push($interests, $key);
        }
        if ($prefix != '') {
            Interests::addInterests($prefix . '_' . $key, $value, $interests);
        } else {
            Interests::addInterests($key, $value, $interests);
        }
      } else {
        if ($prefix != '') {
          array_push($interests, $prefix . '_' . $key);
        } else {
          array_push($interests, $value);
        }
      }
    }
  }

}

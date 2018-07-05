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

    // Interests::addInterests('' , $json, $interests);
    return $json;
  }

  static function addInterests($prefix, $data) {
    global $interests;
    foreach ($data as $key => $value) {
      if (is_array($value)) {
        if ($prefix != '') {
          $interests[$prefix . '_' . $key] = substr_count($prefix . '_' . $key, '_');
        } else {
          $interests[$key] = substr_count($key, '_');
        }
        if ($prefix != '') {
            Interests::addInterests($prefix . '_' . $key, $value);
        } else {
            Interests::addInterests($key, $value);
        }
      } else {
        if ($prefix != '') {
          $interests[$prefix . '_' . $value] = substr_count($prefix . '_' . $value, '_');
        } else {
          $interests[$value] = substr_count($value, '_');
        }
      }
    }
  }

  public static function getInterestsHTML()
  {
    global $htmlArray;
    $htmlArray = array();
    $json = json_decode(\Storage::get('Interests.json'), true);

    Interests::addInterestsHTML('', $json);
    return $htmlArray;
  }

  static function addInterestsHTML($prefix, $data) {
    global $htmlArray;
    $i = 0;
    foreach ($data as $key => $value) {
      if (is_array($value)) {
          if ($prefix != '') {
            $html = '
            <ol><li>
            <div class="remember" style="text-align: left" name="part4">
                    <div class="checkbox">
                      <label>
                        <input name="' . $key . '" type="checkbox" id="' . $key . '">' . $key . '</input>
                      </label>
                    </div>
                  </div>
                  ';
            array_push($htmlArray, $html);

            if(count($value) == 0)
            {
              array_push($htmlArray, '</li></ol>');
            }
            Interests::addInterestsHTML($prefix . '_' . $key, $value);
          } else {
          $html = '<ol><li><div class="remember" style="text-align: left" name="part3">
                  <div class="checkbox">
                    <label>
                      <input name="' . $key . '" type="checkbox" id="' . $key . '">' . $key . '</input>
                    </label>
                  </div>
                </div>
                ';
          array_push($htmlArray, $html);
          Interests::addInterestsHTML($key, $value);
        }
      } else {
        $i++;
        $html = '
        <li>
        <div class="remember" style="text-align: left" name="part1">
                <div class="checkbox">
                  <label>
                    <input name="' . $value . '" type="checkbox" id="' . $value . '">' . $value . '</input>
                  </label>
                </div>
              </div>
              </li>
              ';
                // \Log::info("END! " . count($data) . ' ' . $i . ' '. substr_count($prefix, '_'));
        if($i == 1)
        {
          array_push($htmlArray, '<ol>');
        }
        array_push($htmlArray, $html);
        if($i == count($data))
        {
          for($count = 1; $count <= substr_count($prefix, '_'); $count++)
          {
            array_push($htmlArray, '</ol>');
          }
        }
      }
    }
  }


}

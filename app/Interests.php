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
  protected $guarded = ['id'];

/**
* TOOK FOREVER TO GET THIS TO WORK RECURSIVELY, DON'T FUCK WITH THIS PLEASE.
**/

  public static function getInterests()
  {
    global $interests;
    $interests = array();
    $json = json_decode(\Storage::get('Interests.json'), true);

    Interests::addInterests('' , $json);
    return $interests;
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
            // THESE ARE THE SECOND LEVEL INTERESTS
            $html = '
            <ul class="hidden" id="ulInterest.' . $prefix . '_' . $key . '"><li>
            <div class="remember" style="text-align: left" id="' . ('div.' . $prefix . '_' . $key) . '">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="' . (substr_count($prefix . '_' . $key, '_')) . '" id="' . 'input.' . ($prefix . '_' . $key) . '">' . $key . '</input>
                      </label>
                    </div>
                  </div>
                  ';
            array_push($htmlArray, $html);

            $i++;
            if(count($value) == 0)
            {
              array_push($htmlArray, '</li></ul>');

              if($i == count($data)) {
                for($count = 1; $count <= substr_count($prefix, '_'); $count++)
                {
                  array_push($htmlArray, '</ul>');
                }
              }

            }
            Interests::addInterestsHTML($prefix . '_' . $key, $value);
          } else {
            // THESE ARE THE FIRST LEVEL INTERESTS
          $html = '<ul id="ulInterest.' . $key . '"><li><div class="remember" style="text-align: left" id="' . 'div.' . $key . '">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="0" id="' . 'input.' . $key . '">' . $key . '</input>
                    </label>
                  </div>
                </div>
                ';

          $i++;
          if($i > 1) {
            array_push($htmlArray, '</ul>');
          }
          array_push($htmlArray, $html);
          Interests::addInterestsHTML($key, $value);
        }
      } else {
        // THESE ARE THE THIRD LEVEL INTERESTS
        $i++;
        $html = '
        <li>
        <div class="remember" style="text-align: left" id="' . ('div.' . $prefix . '_' . $value) . '">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="' . (substr_count($prefix . '_' . $value, '_')) . '" id="' . 'input.' . ($prefix . '_' . $value) . '">' . $value . '</input>
                  </label>
                </div>
              </div>
              </li>
              ';
        if($i == 1)
        {
          array_push($htmlArray, '<ul class="hidden" name="bottom" id="ulInterest.' . $prefix . '_' . $value . '">');
        }
        array_push($htmlArray, $html);
        if($i == count($data))
        {
          for($count = 1; $count <= substr_count($prefix, '_'); $count++)
          {
            array_push($htmlArray, '</ul>');
          }
        }
      }
    }
  }


}

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
  public $fillable = array('about');

}

<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\Profile as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Friends extends Model
{

  public $table = 'friends';
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey = 'uuid';
  public $incrementing = false;
  public $fillable = array('friends');

}

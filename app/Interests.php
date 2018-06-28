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

}

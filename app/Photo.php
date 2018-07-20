<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Utilities\UUID;

class Photo extends Model
{

  public $table = 'photos';
  public $timestamps = true;
  protected $connection = 'mysql';
  protected $primaryKey = 'id';
  public $incrementing = true;
  // public $fillable = array('message_history');

}

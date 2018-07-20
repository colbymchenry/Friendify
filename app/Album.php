<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Utilities\UUID;

class Album extends Model
{

  public $table = 'albums';
  public $timestamps = true;
  protected $connection = 'mysql';
  protected $primaryKey = 'id';
  public $incrementing = true;
  // public $fillable = array('message_history');

  static function create($owner, $name)
  {
    $result = Album::where('owner', $owner)->where('name', $name)->get()->first();
    if (count($result) != 0)
    {
      throw new \Exception("An album with that name already exists.");
    }
    else
    {
      $album = new Album;
      $album->owner = $owner;
      $album->name = $name;
      $album->save();
    }

  }

}

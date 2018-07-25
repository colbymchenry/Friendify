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

  static function create($server_id, $owner, $name, $description, $tagged_people)
  {
    $result = Photo::where('owner', $owner)->where('name', $name)->get()->first();
    if (count($result) != 0)
    {
      throw new \Exception("A photo with that name already exists.");
    }
    else
    {
      $photo = new Photo;
      $photo->owner = $owner;
      $photo->name = $name;
      $photo->description = $description;
      $photo->tagged_people = $tagged_people;
      $photo->server_id = $server_id;
      $photo->save();
    }

  }

}

<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Utilities\UUID;
use \App\Server;
use \App\Photo;

class PhotoController extends Controller {

  public function getPhotoView($uuid)
  {
    try {
        $user = User::where('uuid', $uuid)->get()->first();
        $albums = Album::where('owner', $uuid)->get();
        return \View::make('photos')->with('profile', $user)->with('albums', $albums);
    } catch (\Exception $e) {
      \Log::error($e);
    }
  }

  public function createAlbum(Request $request)
  {
    try {
        Album::create(\Session::get('uuid'), $request['name']);
    } catch (\Exception $e) {
      \Log::error($e);
      return response()->json(['failure' => $e->getMessage() ]);
    }
    return response()->json(['success' => 'Album created!' ]);
  }

  public function upload(Request $request)
  {
    $this->validate($request, [ 'user_photo' => 'mimes:png,jpeg,jpg,gif | max:2048', ]);

    $original_name = $request->user_photo->getClientOriginalName();
    $file_path = $request->user_photo->getPathName();
    $photoName = UUID::random() . '.' . $request->user_photo->getClientOriginalExtension();
    $serverId = Server::getAvailableServerID($request->user_photo->getClientSize());

    // TODO: Notify of error;
    if($serverId == -1) {
      return response()->json(['failure' => 'Could not find available server space.' ]);
    }

    try {
      $album = Album::where('owner',  $request->session()->get('uuid'))->where('id', $request->album)->get()->first();

      if (count($album) == 0)
      {
        throw new \Exception("We could not find that album.");
      }

      $user = User::where('uuid', $request->session()->get('uuid'))->get()->first();
      $photoId = Photo::create($serverId, $user->uuid, $photoName, $request->description, '');

      if($photoId != -1)  {
        if($album->photos === '') {
          $album->photos = $photoId;
        } else {
          $album->photos = $album->photos . ',' . $photoId;
        }
        $album->save();
        Server::uploadFile($serverId, '/var/www/html/', $request->user_photo, $photoName);
      }

    } catch (\Exception $e) {
        \Log::error($e);
        return response()->json(['failure' => $e->getMessage() ]);
    }

    return redirect()->route('photos_view', $request->session()->get('uuid'));
  }

  public function delete(Request $request)
  {

  }

  public function like(Request $request)
  {

  }

  public function comment(Request $request)
  {

  }


}

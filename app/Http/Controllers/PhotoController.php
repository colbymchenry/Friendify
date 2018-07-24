<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Album;
use Illuminate\Http\Request;
use App\Http\Controllers\Utilities\UUID;
use \App\Server;

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

  // TODO: Files not writing to server?
  public function upload(Request $request)
  {
    $this->validate($request, [ 'user_photo' => 'mimes:png,jpeg,jpg,gif | max:2048', ]);

    $photoName = UUID::random() . '.' . $request->user_photo->getClientOriginalExtension();

    $serverSpace = Server::getServerSpace("1");

    \Log::info($serverSpace);

    if($serverSpace < 100) {
      return;
    }

    \Log::info($request->user_photo);
    \Log::info($photoName);

    Server::uploadFile("1", $request->user_photo, $photoName);



    // $request->photo->move(public_path('photos'), $photoName);
    //
    // try {
    //   $user = User::where('uuid', $request->session()->get('uuid'))->get()->first();
    //   Photo::create($user->uuid, $photoName, $request['description'], $request['tagged_people']);
    // } catch (\Exception $e) {
    //     \Log::error($e);
    //     return response()->json(['failure' => $e->getMessage() ]);
    // }

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

<?php

namespace App\Http\Controllers;
use \App\User;
use \App\Album;
use Illuminate\Http\Request;

class PhotoController extends Controller {

  public function getPhotoView($uuid)
  {
    try {
        $user = User::where('uuid', $uuid)->get()->first();
        $albums = Album::where('owner', $uuid)->get();
        \Log::info($albums);
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

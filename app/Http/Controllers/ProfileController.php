<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\User;
use Illuminate\Support\Str;

class ProfileController extends Controller
{

  function get($uuid)
  {

    try {

      $user = User::where('uuid', $uuid)->get()->first();

      $top_friends = array(

        array(
          'email' => '',
          'cover_image' => 'img/friend1.jpg',
          'avatar' => 'img/avatar1.jpg',
          'name' => 'Nicholas Grissom',
          'location' => 'San Francisco, CA',
          'friend_count' => '52',
          'photo_count' => '240',
          'video_count' => '16',
          'about' => 'Fuck bitches, get money!',
          'friends_since' => 'December 2014',
          'profile_link' => '#'
        ),

        array(
          'email' => '',
          'cover_image' => 'img/friend2.jpg',
          'avatar' => 'img/avatar2.jpg',
          'name' => 'Colby McHenry',
          'location' => 'Chatsworth, GA',
          'friend_count' => '23',
          'photo_count' => '0',
          'video_count' => '2',
          'about' => 'Everyone can go suck a phat dick!',
          'friends_since' => 'January 1923',
          'profile_link' => '#'
        ),

        array(
          'email' => '',
          'cover_image' => 'img/friend1.jpg',
          'avatar' => 'img/avatar1.jpg',
          'name' => 'Nicholas Grissom',
          'location' => 'San Francisco, CA',
          'friend_count' => '52',
          'photo_count' => '240',
          'video_count' => '16',
          'about' => 'Fuck bitches, get money!',
          'friends_since' => 'December 2014',
          'profile_link' => '#'
        ),

        array(
          'email' => '',
          'cover_image' => 'img/friend2.jpg',
          'avatar' => 'img/avatar2.jpg',
          'name' => 'Colby McHenry',
          'location' => 'Chatsworth, GA',
          'friend_count' => '23',
          'photo_count' => '0',
          'video_count' => '2',
          'about' => 'Everyone can go suck a phat dick!',
          'friends_since' => 'January 1923',
          'profile_link' => '#'
        ),

        array(
          'email' => '',
          'cover_image' => 'img/friend1.jpg',
          'avatar' => 'img/avatar1.jpg',
          'name' => 'Nicholas Grissom',
          'location' => 'San Francisco, CA',
          'friend_count' => '52',
          'photo_count' => '240',
          'video_count' => '16',
          'about' => 'Fuck bitches, get money!',
          'friends_since' => 'December 2014',
          'profile_link' => '#'
        ),

        array(
          'email' => '',
          'cover_image' => 'img/friend2.jpg',
          'avatar' => 'img/avatar2.jpg',
          'name' => 'Colby McHenry',
          'location' => 'Chatsworth, GA',
          'friend_count' => '23',
          'photo_count' => '0',
          'video_count' => '2',
          'about' => 'Everyone can go suck a phat dick!',
          'friends_since' => 'January 1923',
          'profile_link' => '#'
        ),

        array(
          'email' => '',
          'cover_image' => 'img/friend1.jpg',
          'avatar' => 'img/avatar1.jpg',
          'name' => 'Nicholas Grissom',
          'location' => 'San Francisco, CA',
          'friend_count' => '52',
          'photo_count' => '240',
          'video_count' => '16',
          'about' => 'Fuck bitches, get money!',
          'friends_since' => 'December 2014',
          'profile_link' => '#'
        ),

        // array(
        //   'email' => '',
        //   'cover_image' => 'img/friend2.jpg',
        //   'avatar' => 'img/avatar2.jpg',
        //   'name' => 'Colby McHenry',
        //   'location' => 'Chatsworth, GA',
        //   'friend_count' => '23',
        //   'photo_count' => '0',
        //   'video_count' => '2',
        //   'about' => 'Everyone can go suck a phat dick!',
        //   'friends_since' => 'January 1923',
        //   'profile_link' => '#'
        // )

      );

      return \View::make('profile')->with('profile', $user)->with('friends', $top_friends);
    } catch (\Exception $e) {

      return "Fail.<br>Error: $e";

    }

  }

  function me() {
    return self::get(\Session::get('uuid'));
  }

  public function changeCoverImage(Request $request)
  {
    // get current time and append the upload file extension to it,
    // then put that name to $photoName variable.
    $photoName = $request->session()->get('uuid') . '.' . $request->user_photo->getClientOriginalExtension();

<<<<<<< HEAD
    /*
    talk the select file and move it public directory and make avatars
    folder if doesn't exsit then give it that unique name.
    */
    $request->user_photo->move(public_path('cover_images'), $photoName);

    try {
      $user = User::where('uuid', $request->session()->get('uuid'))->get()->first();
      $user->cover_image = 'http://localhost:8000/cover_images/' . $photoName;
      $user->save();
    } catch (\Exception $e) {
        \Log::error($e);
    }

    return redirect()->route('profile');
=======
    $matches = Str::endsWith($photoName, '.png') | Str::endsWith($photoName, '.jpg') | Str::endsWith($photoName, '.jpeg');

    if ($matches) {
      /*
      talk the select file and move it public directory and make avatars
      folder if doesn't exsit then give it that unique name.
      */
      $request->user_photo->move(public_path('cover_images'), $photoName);

      try {
        $user = User::where('uuid', $request->session()->get('uuid'))->get()->first();
        $user->cover_image = 'http://localhost:8000/cover_images/' . $photoName;
        \Log::info($user->uuid);
        $user->save();
      } catch (\Exception $e) {
          \Log::error($e);
      }
    }
    return redirect()->route('profile', $request->session()->get('uuid'));
>>>>>>> 26833bdb35d6cfd58cdcfb98b5ca08a95d5faf03
  }

  public function changeAvatar(Request $request)
  {
    // get current time and append the upload file extension to it,
    // then put that name to $photoName variable.
    $photoName = $request->session()->get('uuid') . '.' . $request->user_photo->getClientOriginalExtension();

    /*
    talk the select file and move it public directory and make avatars
    folder if doesn't exsit then give it that unique name.
    */
    $request->user_photo->move(public_path('avatars'), $photoName);

    try {
      $user = User::where('uuid', $request->session()->get('uuid'))->get()->first();
      $user->avatar = 'http://localhost:8000/avatars/' . $photoName;
      $user->save();
    } catch (\Exception $e) {
        \Log::error($e);
    }

    return redirect()->route('profile');
  }

}

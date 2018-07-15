<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\User;
use \App\Interests;
use Illuminate\Support\Str;
use \App\Profile;
use \App\Relationship;
use \Session;

class ProfileController extends Controller
{

  function get($uuid)
  {
    try {
      $user = User::where('uuid', $uuid)->get()->first();
      $top_friends = array();
      $friends_uuids = explode(';', Relationship::where('uuid', Session::get('uuid'))->first()->friends);
      foreach ($friends_uuids as $uuid) {
        if ($uuid !== '') {
          array_push($top_friends, User::where('uuid', $uuid)->first());
        }
      }
      $requestUUIDS = explode(';', Relationship::where('uuid', Session::get('uuid'))->first()->requests);
      return \View::make('profile')->with('profile', $user)->with('friends', $top_friends)->with('title', $user->firstname . ' ' . $user->lastname)->with('requests', $requestUUIDS);
    } catch (\Exception $e) {
      return "Fail.<br>Error: $e";
    }
  }

  function me() {
    return self::get(\Session::get('uuid'));
  }

  public function changeCoverImage(Request $request)
  {

    $this->validate($request, [ 'user_photo' => 'mimes:png,jpeg,jpg,gif | max:2048', ]);

    // get current time and append the upload file extension to it,
    // then put that name to $photoName variable.
    $photoName = $request->session()->get('uuid') . '.' . $request->user_photo->getClientOriginalExtension();

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

    return redirect()->route('profile', $request->session()->get('uuid'));
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

  public function getAccountSetupView(Request $request)
  {
    try {
        $uuid = $request->session()->get('uuid');
        $user = User::where('uuid', $uuid)->get()->first();
        $user_interests = Interests::where('uuid', $uuid)->get()->first();
        $json = json_decode(\Storage::get('Interests.json'));

        return \View::make('account_setup')->with('profile', $user)->with('user_interests', $user_interests)->with('interests', Interests::getInterestsHTML())->with('json', $json)->with('title', $user->firstname . ' ' . $user->lastname);
    } catch (\Exception $e) {
      \Log::error($e);
    }
  }

  public function setLocation(Request $request)
  {
    try {
        $uuid = $request->session()->get('uuid');
        $user = User::where('uuid', $uuid)->get()->first();
        $interests = Interests::where('uuid', $uuid)->get()->first();

        $user->street_number = $request['street_number'];
        $user->route = $request['route'];
        $user->city = $request['city'];
        $user->state = $request['state'];
        $user->zip_code = $request['zip_code'];
        $user->country = $request['country'];

        $user->save();

        return response()->json(['success' => '/profile']);
    } catch (\Exception $e) {
      \Log::error($e);
      return response()->json(['failure' => $e->getMessage() ]);
    }
  }

  public function setInformation(Request $request)
  {
    try {
        User::where('uuid', $request->session()->get('uuid'))->first()->update(array(
          'firstname' => $request['firstname'],
          'middlename' => $request['middlename'],
          'lastname' => $request['lastname'],
          'email' => $request['email'],
          'phonenumber' => $request['phonenumber'],
        ));
        Profile::where('uuid', $request->session()->get('uuid'))->first()->update(array(
          'about' => $request['about']
        ));
        return response()->json(['success' => '/profile']);
    } catch (\Exception $e) {
      \Log::error($e);
      return response()->json(['failure' => $e->getMessage() ]);
    }
  }

  public function setInterest(Request $request)
  {
    try {
        $json = json_decode(\Storage::get('Interests.json'), true);
        $interests = Interests::getInterests();
        Interests::where('uuid', $request->session()->get('uuid'))->first()->update(array(
          $request['id'] => $request['value'],
        ));
        return response()->json(['success' => '/account_setup']);
    } catch (\Exception $e) {
      \Log::error($e);
      return response()->json(['failure' => $e->getMessage() ]);
    }
  }

}

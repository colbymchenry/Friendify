<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\User;
use \App\Interests;
use Illuminate\Support\Str;
use \App\Profile;

class ProfileController extends Controller
{

  function get($uuid)
  {

    try {

      $user = User::where('uuid', $uuid)->get()->first();

      $top_friends = User::all();

      return \View::make('profile')->with('profile', $user)->with('friends', $top_friends)->with('title', $user->firstname . ' ' . $user->lastname);
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
        $columns = \Schema::getColumnListing('interests');
        $validInterest = false;
        foreach($columns as $column) {
            if($request['id'] == $column) {
              $validInterest = true;
              break;
            }
        }

        if($validInterest == false) {
          throw new \Exception('Invalid interest selection: "' + $request['id'] + '"');
          return;
        }

        if($request['value'] != 0 && $request['value'] != 1) {
          throw new \Exception("Invalid value for interest");
          return;
        }

        Interests::where('uuid', $request->session()->get('uuid'))->first()->update(array(
          $request['id'] => $request['value'],
        ));

        /**
    		* THIS HANDLES ALL PARENT ELEMENTS, BY TURNING THEM ON
    		**/
    		if($request['value'] == 1) {
          foreach(explode('_', $request['id']) as $index=>$value) {
            $totalID = '';
              foreach(explode('_', $request['id']) as $index1=>$value1) {
                \Log::info($index1 . ',' . $index);
                if($index1 < $index) {
                  $totalID .= explode('_', $request['id'])[$index1] . '_';
                }
              }
              $totalID = substr($totalID, 0, strlen($totalID) - 1);

              if($totalID != '') {
                foreach($columns as $column) {
                  if($column == $totalID && $column != $request['id']) {
                    Interests::where('uuid', $request->session()->get('uuid'))->first()->update(array(
                      $column => $request['value'],
                    ));
                  }
                }
              }
          }
    		} else {
    			/**
    			* THIS HANDLES UPDATING ALL CHILD ELEMENTS, BY TURNING THEM OFF
    			**/
          foreach($columns as $column) {
            if(strpos($column, $request['id']) !== false && $column !== $request['id']) {
              Interests::where('uuid', $request->session()->get('uuid'))->first()->update(array(
                $column => $request['value'],
              ));
            }
          }
    		}


        return response()->json(['success' => '/account_setup']);
    } catch (\Exception $e) {
      \Log::error($e);
      return response()->json(['failure' => $e->getMessage() ]);
    }
  }

}

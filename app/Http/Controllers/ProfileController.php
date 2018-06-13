<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{

  // function test($value) {
  //   $value = $value + 1;
  //   return \View::make('test')->with('value', $value);
  // }

  function make($uuid)
  {

    \Log::info($uuid);

    try {

    $result = new \App\User($uuid);
    \Log::info($result);
    return $result->firstname;

    } catch (\Exception $e) {

    }

    // \Log::info($uuid);

    // return $uuid;

    // $result = new \App\User($uuid);

    $user = array(

      'cover_image' => 'img/top-header1.jpg',
      'avatar' => 'img/author-main1.jpg',
      // 'first_name' => $result->firstname,
      // 'last_name' => $result->lastname,
      'first_name' => 'Seth',
      'last_name' => 'Peden',
      'location' => 'NULL',
      'friend_count' => '0'

    );

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
      )

    );

    return \View::make('profile')->with('user', $user)->with('friends', $top_friends);
  }

}

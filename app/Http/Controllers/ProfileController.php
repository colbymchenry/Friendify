<?php

namespace App\Http\Controllers;

class ProfileController extends Controller
{

  function make($uuid)
  {

    try {

      $user = new \App\User($uuid);

      $profile = array(

        'cover_image' => 'img/top-header1.jpg',
        'avatar' => 'img/author-main1.jpg',
        'first_name' => $user->firstname,
        'last_name' => $user->lastname,
        // 'first_name' => 'Seth',
        // 'last_name' => 'Peden',
        'location' => 'NULL',
        'friend_count' => '0'

      );

      \Log::info($profile);
      // return "<h1>$user->firstname $user->lastname</h1>";

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

      \Log::info($profile);

      return \View::make('profile')->with('profile', $profile)->with('friends', $top_friends);

    } catch (\Exception $e) {

      return 'Fail.';

    }

  }

}

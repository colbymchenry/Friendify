<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{

  function index()
  {

    $user = array(

      'cover_image' => 'img/top-header1.jpg',
      'avatar' => 'img/author-main1.jpg',
      'first_name' => 'Seth',
      'last_name' => 'Peden',
      'location' => 'San Francisco, CA',
      'friend_count' => '86'

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
        'name' => 'Seth Peden',
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

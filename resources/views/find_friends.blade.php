@php

use \App\User;
use \App\Profile;
use \App\Friends;

@endphp

@extends('layouts.master')

@section('scripts')

<script>

const to_load = 3;
var loaded = 0;
var search_string = 'NULL';

const friend_match = `
<div class="ui-block">
  <!-- Search Result -->
  <article class="hentry post searches-item">

    <div class="post__author author vcard inline-items">
      <img src="@AVATAR@" alt="author">

      <div class="author-date">
        <a class="h6 post__author-name fn" href="02-ProfilePage.html">@FIRSTNAME@ @LASTNAME@</a>
        <div class="country">@LOCATION@</div>
      </div>

      <span class="notification-icon">
        <a href="#" class="accept-request" style="background-color: yellow;">
          <svg class="olymp-chat---messages-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-chat---messages-icon') }}"></use></svg>
        </a>

        <a href="#" class="accept-request">
          <span class="icon-add without-text">
            <svg class="olymp-happy-face-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-happy-face-icon') }}"></use></svg>
          </span>
        </a>

        <a href="#" class="accept-request chat-message">
          <svg class="olymp-chat---messages-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-chat---messages-icon') }}"></use></svg>
        </a>
      </span>

      <div class="more">
        <svg class="olymp-three-dots-icon"><use xlink:href="{{ asset('svg-icons/sprites/icons.svg#olymp-three-dots-icon') }}"></use></svg>
        <ul class="more-dropdown">
          <li>
            <a href="#">Edit Post</a>
          </li>
          <li>
            <a href="#">Delete Post</a>
          </li>
          <li>
            <a href="#">Turn Off Notifications</a>
          </li>
          <li>
            <a href="#">Select as Featured</a>
          </li>
        </ul>
      </div>

    </div>

    <p class="user-description">
      <span class="title">About Me:</span> Hi!, I’m Marina and I’m a Community Manager for “Gametube”. Gamer and full-time mother.
      <span class="title">Favourite TV Shows:</span> Breaking Good, RedDevil, People of Interest, The...
    </p>

    <div class="post-additional-info">

      <ul class="friends-harmonic">
        <li>
          <a href="#">
            <img src="img/friend-harmonic9.jpg" alt="friend">
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/friend-harmonic10.jpg" alt="friend">
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/friend-harmonic7.jpg" alt="friend">
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/friend-harmonic8.jpg" alt="friend">
          </a>
        </li>
        <li>
          <a href="#">
            <img src="img/friend-harmonic11.jpg" alt="friend">
          </a>
        </li>
      </ul>
      <div class="names-people-likes">
        You and Marina have
        <a href="#">4 Friends in Common</a>
      </div>

      <div class="friend-count">
        <a href="#" class="friend-count-item">
          <div class="h6">189</div>
          <div class="title">Friends</div>
        </a>
      </div>

    </div>

  </article>
  <!-- ... end Search Result -->
</div>
`;

$(document).ready(function() {

  $('#search-items-grid').css('height', window.innerHeight * 1.1);

  load();

  function load() {
    $.ajax({
      method : 'POST',
      url : '{{ route('search_matches') }}',
      data : {
        uuid : "{{ Session::get('uuid') }}",
        to_load : to_load,
        loaded : loaded,
        search_string : search_string,
        _token : token
      }
    }).done(function(msg) {
      loaded = msg['output'].length;
      $('#search-items-grid').html('');
      for (var i = 0; i < msg['output'].length; i++) {
        var result = friend_match.replace('@FIRSTNAME@', msg['output'][i]['firstname'])
        .replace('@LASTNAME@', msg['output'][i]['lastname']).replace('@LOCATION@', msg['output'][i]['location'])
        .replace('@AVATAR@', msg['output'][i]['avatar']);
        $('#search-items-grid').html($('#search-items-grid').html() + result);
      }
    });
    $('#desctiption-results').html('Showing ' + loaded + ' results for: \“<span class=\"c-primary\">' + search_string + '</span>\”');
  }

  window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) / document.body.offsetHeight >= 0.8 ) {
      load();
    }
  };

});

</script>

@endsection

@section('content')

<!-- Main Content -->

<div class="container">

  <div class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
    <div class="ui-block">
      <div class="ui-block-title">
        <div class="h6 title" id="desctiption-results">Showing 0 Results for: “<span class="c-primary"></span>”</div>
      </div>
    </div>

    <div id="search-items-grid">

    </div>
  </div>
</div>

<!-- ... end Main Content -->

@endsection

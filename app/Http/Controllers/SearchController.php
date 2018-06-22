<?php

namespace App\Http\Controllers;
use \App\User;

class SearchController extends Controller {

  static $min_match_score = 1;

  function find_friends() {
    $profile = '';
    return \View::make('find_friends')->with('profile', $profile);
  }

  public function search_matches(\Illuminate\Http\Request $request) {
    try {
      $loaded = 0;
      $users = User::all()->toArray();
      $limit = min(count($users) - 1, $request['loaded'] + $request['to_load']);
      $output = array();
      $index = 0;
      \Log::info('UUID: ' . $request['uuid']);
      $user = User::where('uuid', $request['uuid'])->get()->first();
      \Log::info($user->uuid);
      // \Log::info($users[0]->uuid);
      while ($loaded < $limit && $index < count($users)) {
        // if ($users[$index]->uuid != $user->uuid) {
          // \Log::info($user->match_score_with($users[$index]));
          // if ($user->match_score_with($users[$index]) >= self::$min_match_score) {
      //       \Log::info($match['firstname'] . " " . $match['lastname'] . ": " . $user->match_score_with($match));
      //       $loaded++;
      //       array_push($output, $match->toArray());
      //     }
        // }
        $index++;
      }
      return response()->json(['output' => $output, 'loaded' => $loaded]);
    } catch (Exception $e) {
      \Log::info($e);
    }
  }

}

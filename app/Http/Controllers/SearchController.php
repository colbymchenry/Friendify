<?php

namespace App\Http\Controllers;

class SearchController extends Controller {

  $min_match_score = 1;

  function find_friends() {
    $profile = '';
    return \View::make('find_friends')->with('profile', $profile);
  }

  public function search_matches(\Illuminate\Http\Request $request) {
    try {
      $loaded = 0;
      $results = \DB::table('users')->get()->toArray();
      $limit = min(count($results) - 1, $request['loaded'] + $request['to_load']);
      $output = array();
      $index = 0;
      $user = new \App\User($request['uuid']);
      while ($loaded < $limit && $index < count($results)) {
        if ($results[$index]->uuid != $request['uuid']) {
          $match = new \App\User($results[$index]->uuid);
          if ($user->match_score_with($match) >= $min_match_score) {
            $loaded++;
            array_push($output, $match->to_array());
          }
        }
        $index++;
      }
      return response()->json(['output' => $output, 'loaded' => $loaded]);
    } catch (Exception $e) {
      \Log::info($e);
    }
  }

}

<?php

namespace App\Http\Controllers;
use \App\User;

class SearchController extends Controller {

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
<<<<<<< HEAD
      for ($i = 0; $i < $limit; $i++) {
        $user = User::where('uuid', $results[$i]->uuid);
        array_push($output, $user->to_array());
=======
      $index = 0;
      $user = new \App\User($request['uuid']);
      while ($loaded < $limit && $index < count($results)) {
        if ($results[$index]->uuid != $request['uuid']) {
          $match = new \App\User($results[$index]->uuid);
          if ($user->match_score_with($match) > 0) {
            $loaded++;
            array_push($output, $match->to_array());
          }
        }
        $index++;
>>>>>>> f71cdf06965a1b17e2922b922ab68944a7b61131
      }
      return response()->json(['output' => $output, 'loaded' => $loaded]);
    } catch (Exception $e) {
      \Log::info($e);
    }
  }

}

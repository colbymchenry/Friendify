<?php

namespace App\Http\Controllers;

class SearchController extends Controller {

  function search_people() {
    $profile = '';
    return \View::make('search_people')->with('profile', $profile);
  }

  public function search_matches(\Illuminate\Http\Request $request) {
    try {
      $results = \DB::table('users')->get()->toArray();
      $limit = min(count($results), $request['loaded'] + $request['to_load']);
      $output = array();
      for ($i = 0; $i < $limit; $i++) {
        $user = new \App\User($results[$i]->uuid);
        array_push($output, $user->to_array());
      }
      \Log::info($output);
      return response()->json(['success' => $output]);
    } catch (Exception $e) {
      \Log::info($e);
    }
  }

}

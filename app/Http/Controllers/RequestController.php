<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\User;
use \App\Interests;
use Illuminate\Support\Str;
use \App\Profile;
use \App\Relationship;
use \Session;

class RequestController extends Controller {

  public function update(Request $request) {
    $relationship = Relationship::where('uuid', $request['profile'])->first();
    return response()->json(
      ['success' => ['friends?' => strpos($relationship->friends, $request->session()->get('uuid')),
                    'requested?' => strpos($relationship->requests, $request->session()->get('uuid'))]
    ]);
  }

  public function add(Request $request) {
    $relationship = Relationship::where('uuid', $request['receiver'])->first();
    \Log::info(strpos($relationship->requests, $request->session()->get('uuid')));
    if (strpos($relationship->requests, $request->session()->get('uuid')) == false) {
      $relationship->requests = $request->session()->get('uuid') . ';' . Relationship::where('uuid', $request['receiver'])->first()->requests;
      $relationship->save();
      return response()->json(['success' => ['Request Sent!', '']]);
    } elseif (strpos($relationship->friends, $request->session()->get('uuid')) == false) {
      return response()->json(['failure' => ['You are already friends.', '']]);
    } else {
      return response()->json(['failure' => ['A request has already been sent.', '']]);
    }
  }

  public function remove(Request $request) {
    $receiverRelationship = Relationship::where('uuid', $request['receiver'])->first();
    $sessionRelationship = Relationship::where('uuid', $request->session()->get('uuid'))->first();
    $receiverRelationship->requests = str_replace(Session::get('uuid') . ';', '', $receiverRelationship->requests);
    $receiverRelationship->friends = str_replace(Session::get('uuid') . ';', '', $receiverRelationship->friends);
    $receiverRelationship->save();
    $sessionRelationship->friends = str_replace($request['receiver'] . ';', '', $sessionRelationship->friends);
    $sessionRelationship->save();
    return response()->json(['success' => ['Removed!', '']]);
  }

  public function accept(Request $request) {
    $sessionRelationship = Relationship::where('uuid', $request->session()->get('uuid'))->first();
    $requestRelationship = Relationship::where('uuid', $request['requestUUID'])->first();
    $sessionRelationship->requests = str_replace($request['requestUUID'] . ';', '', $sessionRelationship->requests);
    $sessionRelationship->friends = $request['requestUUID'] . ';' . $sessionRelationship->friends;
    $sessionRelationship->save();
    $requestRelationship->friends = $request->session()->get('uuid') . ';' . $requestRelationship->friends;
    $requestRelationship->save();
    return response()->json(['success' => ['Accepted!', '']]);
  }

  public function deny(Request $request) {
    $sessionRelationship = Relationship::where('uuid', $request->session()->get('uuid'))->first();
    $requestRelationship = Relationship::where('uuid', $request['requestUUID'])->first();
    $sessionRelationship->requests = str_replace($request['requestUUID'] . ';', '', $sessionRelationship->requests);
    $sessionRelationship->save();
    return response()->json(['success' => ['Removed!', '']]);
  }

}

?>

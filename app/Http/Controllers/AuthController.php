<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{

  public function register(\Illuminate\Http\Request $request)
  {
      try {
        \App\User::create($request['firstname'], $request['lastname'], $request['email'], $request['password'], $request['dob'], $request['gender']);
      } catch (\Exception $e) {
          return response()->json(['failure' => $e->getMessage() ]);
      }
      return response()->json(['success' => ['Registration Complete', 'Check inbox and verify email.']]);
  }

}

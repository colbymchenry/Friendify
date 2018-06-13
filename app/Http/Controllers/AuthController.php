<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{

  public function register(\Illuminate\Http\Request $request)
  {
      \App\User::create($request['firstname'], $request['lastname'], $request['email'], $request['password'], $request['dob'], $request['gender']);
      return response()->json(['message' => 'Data is successfully added']);
  }

}

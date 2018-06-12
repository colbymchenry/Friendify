<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{

  function register(\Request $request)
  {
      dd($request->$id);
      return response()->json(['success'=>'Data is successfully added']);
  }

}

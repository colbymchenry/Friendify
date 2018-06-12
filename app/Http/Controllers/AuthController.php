<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{

  function register(\Request $request)
  {
    \Log::info("CINNAMON");
      \DB::statement("CREATE TABLE IF NOT EXISTS users (firstname TEXT, lastname TEXT, email TEXT, password TEXT, dob TEXT, gender BOOLEAN)");
      return response()->json(['success'=>'Data is successfully added']);
  }

}

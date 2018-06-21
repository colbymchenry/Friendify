<?php

namespace App\Http\Controllers;

class AuthController extends Controller
{

  public function register(\Illuminate\Http\Request $request)
  {
      try {
        if($request['eula'] == 'false')
        {
          throw new \Exception('You must agree to the EULA.');
        }
        $validator = $this->validator($request->all());
        if($validator->fails())
        {
          throw new \Exception($validator->errors()->first());
        }
        $uuid = \App\User::create($request['firstname'], $request['lastname'], $request['email'], \Hash::make($request['password']), $request['dob'], $request['gender']);
      } catch (\Exception $e) {
          return response()->json(['failure' => $e->getMessage() ]);
      }
      return response()->json(['success' => ['Registration Complete', 'Check inbox and verify email.']]);
  }

  protected function validator(array $data)
  {
      return \Validator::make($data, [
          'firstname' => 'required|string|max:255',
          'lastname' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:6',
          'gender' => 'required|boolean',
          'dob' => 'required|string|date',
      ]);
  }

  public function login(\Illuminate\Http\Request $request)
  {
    $email = $request['email'];
    $password = $request['password'];

    $result = \DB::table('users')->where('email', $email)->first();

    if(count($result) == 0) {
      return response()->json(['failure' => ['Sorry!', 'Incorrect Email/Password']]);
    }

    $getpassword = \DB::table('users')->select('hashed_password')->where('email', $email)->first();

    if(password_verify($password, $getpassword->hashed_password) == false) {
      return response()->json(['failure' => ['Sorry!', 'Incorrect Email/Password']]);
    }

    \Log::info($request->session()->all());

    $request->session()->put('uuid', $result->uuid);
    $request->session()->save();
    \Session::save();
    return response()->json(['success' => '/profile/' . $result->uuid]);
  }

  public function logout(\Illuminate\Http\Request $request)
  {
    $request->session()->flush();
  }

}

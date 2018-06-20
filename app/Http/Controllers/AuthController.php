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
        \App\User::create($request['firstname'], $request['lastname'], $request['email'], \Hash::make($request['password']), $request['dob'], $request['gender']);
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

}

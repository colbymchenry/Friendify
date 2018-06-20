<?php

namespace App\Http\Controllers\Utilities;

class Validator {

  static function validate_email($email)
  {
      $my_data = [
          'email' => $email,
      ];
      $validator = Validator::make($my_data, [
          'email' => 'email',
      ]);
      if ($validator->fails()) {
          return false;
      } else {
          return true;
      }
  }

}

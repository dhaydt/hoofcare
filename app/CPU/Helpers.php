<?php

namespace App\CPU;

class Helpers
{
  public static function response_format($code, $status, $message, $data)
  {
    $data = [
      "code" => $code,
      "status" => $status,
      "message" => $message,
      "data" => $data
    ];

    return $data;
  }
  
  public static function error_processor($validator, $code, $status, $message, $data)
  {
    $err_keeper = [];
    foreach ($validator->errors()->getMessages() as $index => $error) {
      array_push($err_keeper, ['code' => $index, 'message' => $error[0]]);
    }

    $data = [
      "code" => $code,
      "status" => $status,
      "message" => $message,
      "data" => $err_keeper
    ];

    return $data;
  }
}
<?php

namespace App\CPU;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class Helpers
{
  public static function getCategory($id){
    if($id == 0){
      return 'Home';
    }else{
      $cat = Category::find($id);
      return $cat['name'];
    }
  }
  public static function deleteImg($full_path)
  {
    $dir = str_replace('storage/', '', $full_path);
    if (Storage::disk('public')->exists($dir)) {
      Storage::disk('public')->delete($dir);
    }

    return [
      'success' => 1,
      'message' => 'Removed successfully !',
    ];
  }

  public static function getMenu(){
    $data = Category::get();
    foreach($data as $d){
      $d['list'] = Item::where('category_id', $d['id'])->where('is_public', 1)->orderBy('updated_at', 'desc')->get();
    }
    return $data;
  }
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
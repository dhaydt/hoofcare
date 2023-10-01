<?php

namespace App\CPU;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class Helpers
{
  public static function formatIklan($iklan)
  {
    $newIklan = [];

    foreach ($iklan as $ik) {
      $il = [
        'id' => $ik['id'],
        'title' => $ik['title'],
        'image' => asset('storage/' . $ik['image']),
      ];

      array_push($newIklan, $il);
    }

    return $newIklan;
  }

  public static function formatItems($items)
  {
    $newItems = [];

    foreach ($items as $key => $i) {
      $it = [
        'id' => $i['id'],
        'name' => $i['name'],
        'description' => $i['description'],
        'online_link' => $i['online_link'],
        'pic1' => $i['pic1'] ? asset('storage/' . $i['pic1']) : null,
        'pic2' => $i['pic2'] ? asset('storage/' . $i['pic2']) : null,
        'pic3' => $i['pic3'] ? asset('storage/' . $i['pic3']) : null,
        'pic4' => $i['pic4'] ? asset('storage/' . $i['pic4']) : null,
        'pic5' => $i['pic5'] ? asset('storage/' . $i['pic5']) : null,
        'file_link1' => $i['file_link1'] ? asset('storage/' . $i['file_link1']) : null,
        'file_link2' => $i['file_link2'] ? asset('storage/' . $i['file_link2']) : null,
        'credit' => $i['credit']
      ];

      array_push($newItems, $it);
    }
    return $newItems;
  }

  public static function getCategory($id)
  {
    if ($id == 0) {
      return 'Home';
    } else {
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

  public static function getMenu()
  {
    $data = Category::get();
    foreach ($data as $d) {
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

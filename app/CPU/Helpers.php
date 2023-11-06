<?php

namespace App\CPU;

use App\Models\Category;
use App\Models\Config;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class Helpers
{
  public static function getDistance($zip1, $zip2)
  {
    $client = new \GuzzleHttp\Client();
    $response = $client->get(
      "https://api.zipcodestack.com/v1/distance",
      [
        "headers" => [
          "apikey" => "01HCVH9N38025RFYY9WTVYR3C1",
        ],
        "query" => [
          "code" => $zip1,
          "compare" => $zip2,
          "country" => "us",
          "unit" => "km",
        ],
      ]
    );
    $body = $response->getBody();

    return json_decode((string) $body);
  }
  public static function serviceList()
  {
    $service = ['Metal shoeing' => 'Metal shoeing', 'Barefoot trim' => 'Barefoot trim', 'Rehab trim' => 'Rehab trim', 'Gluing' => 'Gluing'];

    return $service;
  }
  public static function deletePdf($old_image)
  {
    if (Storage::disk('public')->exists($old_image)) {
      Storage::disk('public')->delete($old_image);
    }
  }
  public static function savePdf(string $dir, string $format, $image = null)
  {
    $imageName = $format;

    if (!Storage::disk('public')->exists($dir)) {
      Storage::disk('public')->makeDirectory($dir);
    }

    Storage::disk('public')->put($dir . $imageName, file_get_contents($image));

    return $dir . $imageName;
  }

  public static function getConfig($title)
  {
    $config = Config::where('title', $title)->first();

    $val = 'unset';
    if ($config) {
      $val = $config['value'];
    }

    return $val;
  }

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
      if(isset($i['file1']['id'])){
        if($i['file1']['count'] > 0){
          $link1 = env('APP_URL').'api/flipped/'.$i['file_link1'];
        }else{
          $link1 = null;
        }
      }else{
        $link1 = null;
      }
      
      if(isset($i['file2']['id'])){
        if($i['file2']['count'] > 0){
          $link2 = env('APP_URL').'api/flipped/'.$i['file_link2'];
        }else{
          $link2 = null;
        }
      }else{
        $link2 = null;
      }
      
      $it = [
        'id' => $i['id'],
        'name' => $i['name'],
        'description' => $i['description'],
        'category_id' => $i['category_id'],
        'category_name' => $i['category']['name'] ?? 'Invalid category',
        'online_link' => route('item.detail', [$i['id'], str_replace(' ', '%20', $i['name'])]),
        'pic1' => $i['pic1'] ? asset('storage/' . $i['pic1']) : null,
        'pic2' => $i['pic2'] ? asset('storage/' . $i['pic2']) : null,
        'pic3' => $i['pic3'] ? asset('storage/' . $i['pic3']) : null,
        'pic4' => $i['pic4'] ? asset('storage/' . $i['pic4']) : null,
        'pic5' => $i['pic5'] ? asset('storage/' . $i['pic5']) : null,
        'file_link1' => $i['file1'] ? asset('storage/' . str_replace(' ', '%20', $i['file1']['file'])) : null,
        'file_link2' => $i['file2'] ? asset('storage/' . str_replace(' ', '%20', $i['file2']['file'])) : null,
        'fliped_file_link1' => $link1,
        'fliped_file_link2' => $link2,
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
    } elseif ($id == 9999) {
      return 'Items';
    } elseif ($id == 9998) {
      return 'Contact';
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
      $d['list'] = Item::where('category_id', $d['id'])->where('is_public', 1)->orderBy('name', 'asc')->get();
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

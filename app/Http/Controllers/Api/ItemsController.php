<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function detail_items($id){
        $item = Item::where('id', $id)->get();
        $format = [];

        if($item){
            $format = Helpers::formatItems($item);
        }

        $data['data'] = $format[0];

        return response()->json(Helpers::response_format(200, true, "success", $data));
    }
}

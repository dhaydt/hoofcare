<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function home(){
        $category = Category::get();

        $newCatgeory = [];

        foreach($category as $c){
            $items = Item::where(['category_id' => $c['id']])->orderBy('created_at', 'desc')->limit(4)->get();
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

            $c['items'] = $newItems;

            array_push($newCatgeory, $c);
        }

        $iklan = Ads::where(['show_in' => 0, 'status' => 1])->orderBy('created_at', 'desc')->get();
        $newIklan = [];

        foreach($iklan as $ik){
            $il = [
                'id' => $ik['id'],
                'title' => $ik['title'],
                'image' => asset('storage/' . $ik['image']),
            ];

            array_push($newIklan, $il);
        }

        $data['iklan'] = $newIklan;
        $data['categories'] = $newCatgeory;

        return response()->json(Helpers::response_format(200, true, "success", $data));
    }

    public function getMenu(){
        $data = Category::get();
        $newData = [];

        foreach ($data as $key => $d) {
            array_push($newData, ['id' => $d['id'], 'name' => $d['name']]);
        }

        return response()->json(Helpers::response_format(200, true, "success", [$newData]));
    }
}

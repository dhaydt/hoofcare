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
            $newItems = Helpers::formatItems($items);

            $c['items'] = $newItems;

            array_push($newCatgeory, $c);
        }

        $iklan = Ads::where(['show_in' => 0, 'status' => 1])->orderBy('created_at', 'desc')->get();
        $newIklan = Helpers::formatIklan($iklan);

        $data['iklan'] = $newIklan;
        $data['categories'] = $newCatgeory;

        return response()->json(Helpers::response_format(200, true, "success", $data));
    }

    public function dynamic_menu_dashboard(Request $request, $id = 0){
        $user = $request->user();

        if($id == 0){
            $data = Item::where(['user_id' => $user['id']])->orderBy('created_at', 'desc')->get();

            $data = Helpers::formatItems($data);

            return response()->json(Helpers::response_format(200, true, "success", $data));
        }else{
            $category = Category::find($id);

            if($category){
    
                $data = Item::where(['category_id' => $id, 'user_id' => $user['id']])->orderBy('created_at', 'desc')->get();

                $data = Helpers::formatItems($data);
    
                return response()->json(Helpers::response_format(200, true, "success", $data));
            }

            return response()
                    ->json(['status' => 'error', 'message' => 'Category id not found!'], 200);
        }


    }

    public function dynamic_menu($id){

        $iklan = Ads::where(['show_in' => $id, 'status' => 1])->orderBy('created_at', 'desc')->get();

        $items = Item::where(['category_id' => $id])->orderBy('created_at', 'desc')->get();

        $newItems = Helpers::formatItems($items);

        $newIklan = Helpers::formatIklan($iklan);


        $data['iklan'] = $newIklan;
        $data['items'] = $newItems;

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

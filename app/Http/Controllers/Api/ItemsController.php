<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Flip;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Imagick;
use Illuminate\Support\Str;

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
    
    public function flip_detail_items($id){

        $flip = Flip::find($id);
        $data['images'] = [];

        if($flip['count'] > 0){
            for($i=1; $i <= $flip['count']; $i++){
                $name = str_replace(' ', '%20',$flip['name']);
                array_push($data['images'], asset('storage/flip/'.$name.'/'.$name. '-'.$i - 1 .'.jpg'));
            }
        }

        return response()->json(Helpers::response_format(200, true, "success", $data));
    }

    public function item_update(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'category_id' => 'required',
            'name' => 'required',
        ], [
            'item_id.required' => 'item id required!',
            'category_id.required' => 'category required!',
            'name.required' => 'name required!',
        ]);

        if ($validator->fails()) {
            return response()->json(Helpers::error_processor($validator, 403, false, 'error', null), 403);
        }

        $item = Item::find($request->item_id);

        if($item){
            $data = $request;

            $item->category_id = $data->category_id;
            $item->name = $data->name;
            $item->description = $data->description;
            $item->online_link = route('item.detail', [$item['id'], $data['name']]);

            $dir = 'picture/';

            if($request->file('pic1')){
                $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
                $request->file('pic1')->storeAs('public/' . $dir, $imgName);
                Helpers::deleteImg($item['pic1']);
                $item->pic1 = $dir . $imgName;
            }
            if($request->file('pic2')){
                $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
                $request->file('pic2')->storeAs('public/' . $dir, $imgName);
                Helpers::deleteImg($item['pic2']);
                $item->pic2 = $dir . $imgName;
            }
            if($request->file('pic3')){
                $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
                $request->file('pic3')->storeAs('public/' . $dir, $imgName);
                Helpers::deleteImg($item['pic3']);
                $item->pic3 = $dir . $imgName;
            }
            if($request->file('pic4')){
                $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
                $request->file('pic4')->storeAs('public/' . $dir, $imgName);
                Helpers::deleteImg($item['pic4']);
                $item->pic4 = $dir . $imgName;
            }
            if($request->file('pic5')){
                $imgName = Carbon::now()->toDateString() . '-' . uniqid() . '.' . 'png';
                $request->file('pic5')->storeAs('public/' . $dir, $imgName);
                Helpers::deleteImg($item['pic5']);
                $item->pic5 = $dir . $imgName;
            }

            if($request->file('file1')){
                $pdf = $request->file('file1');
                $name = $pdf->getClientOriginalName();
                $dir = 'file/';

                $pdftext = file_get_contents($pdf);
                $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);

                $imagick = new Imagick();

                $imagick->readImage($pdf);
                File::ensureDirectoryExists(storage_path('app/public/flip'.'/'.$name));

                $imagick->writeImages(storage_path('app/public/flip'.'/'.$name.'/'.$name.'.jpg'), true);

                $files1 = File::files(storage_path('app/public/flip'.'/'.$name));

                $flip1_id = $item['file1']['id'] ?? null;

                if($flip1_id != null){
                    $flip1 = Flip::find($flip1_id);
                    File::deleteDirectory(storage_path('app/public/flip'.'/'.$flip1['name']));

                }else{
                    $flip1 = new Flip();
                }

                $flip1->name = $name;
                $flip1->file = Helpers::savePdf($dir, $name, $pdf);
                $flip1->count = count($files1) ?? 0;

                $flip1->save();

                Helpers::deletePdf($item['file1']['file'] ?? 'null');


                $item->file_link1 = $flip1['id'];
            }
            
            if($request->file('file2')){
                $pdf = $request->file('file2');
                $name = $pdf->getClientOriginalName();
                $dir = 'file/';

                $pdftext = file_get_contents($pdf);
                $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);

                $imagick = new Imagick();

                $imagick->readImage($pdf);
                File::ensureDirectoryExists(storage_path('app/public/flip'.'/'.$name));

                $imagick->writeImages(storage_path('app/public/flip'.'/'.$name.'/'.$name.'.jpg'), true);

                $files2 = File::files(storage_path('app/public/flip'.'/'.$name));

                $flip2_id = $item['file2']['id'] ?? null;

                if($flip2_id != null){
                    $flip2 = Flip::find($flip2_id);
                    File::deleteDirectory(storage_path('app/public/flip'.'/'.$flip2['name']));
                }else{
                    $flip2 = new Flip();
                }

                $flip2->name = $name;
                $flip2->file = Helpers::savePdf($dir, $name, $pdf);
                $flip2->count = count($files2) ?? 0;

                $flip2->save();

                Helpers::deletePdf($item['file2']['file'] ?? 'null');


                $item->file_link2 = $flip2['id'];
            }

            $item->save();

            return response()->json(Helpers::response_format(200, true, "success", ["message" => 'Item updated successfully']));

        }

        return response()->json(['status' => 'error', 'message' => 'Item not found!'], 200);
    }

    public function delete_item($id){
        $item = Item::find($id);

        if($item){
            Helpers::deleteImg($item['pic1']);
            Helpers::deleteImg($item['pic2']);
            $item->delete();
    
            return response()->json(Helpers::response_format(200, true, "success", ['message' => 'Item deleted successfully']));
        }
        
        return response()->json(['status' => 'error', 'message' => 'Item not found!'], 200);
    }

}

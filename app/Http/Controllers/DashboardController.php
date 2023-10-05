<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Flip;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Imagick;

class DashboardController extends Controller
{
    public function post_item(Request $request){
        $validate = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
        ], [
            'name.required' => "Item title/name is required",
            'category.required' => 'select category!!',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error');
        }

        // if
        dd($request);
    }
    
    public function update_item(Request $request){
        $data = $request->only('category', 'name');
        $validate = Validator::make($data, [
            'name' => 'required',
            'category' => 'required',
        ], [
            'name.required' => "Item name is required",
            'category.required' => 'select category!!',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('error');
        }

        $item = Item::with('file1', 'file2')->find($request->id);

        $item->name = $request->name;
        $item->category_id = $request->category;
        $item->description = $request->description;
        $item->online_link = $request->online_link;
        $item->credit = $request->credit;

        if($request->file1){
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
        
        if($request->file2){
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
        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    public function index(){
        $data['title'] = 'Dashboard';
        $data['active'] = 'dashboard';
        $data['breadcumb'] = 'Dashboard';

        $data['category'] = Category::get();
        $data['menu'] = Category::get();

        return view('pages.dashboard.index', $data);
    }
    
    public function library(){
        $data['title'] = 'Library';
        $data['active'] = 'library';
        $data['breadcumb'] = 'Library';

        $data['category'] = Category::get();
        $data['menu'] = Category::get();

        return view('pages.dashboard.library', $data);
    }
    
    public function detail_item($id){
        $item = Item::find($id);

        $data['title'] = $item['name'];
        $data['active'] = 'detail_item';
        $data['breadcumb'] = 'Detail Item';

        $data['category'] = Category::get();
        $data['menu'] = Category::get();

        $data['data'] = $item;

        return view('pages.dashboard.detail_item', $data);
    }
    
    public function add_item(){

        $data['title'] = 'Add New Item';
        $data['active'] = 'add_item';
        $data['breadcumb'] = 'Add New Item';

        $data['category'] = Category::get();
        $data['menu'] = Category::get();

        $data['data'] = [];

        return view('pages.dashboard.detail_item', $data);
    }
    
    public function dynamic_menu($id){

        $category = Category::find($id);

        if($category){
            $data['title'] = $category['name'];
            $data['active'] = $category['id'];
            $data['breadcumb'] = $category['name'];
    
            $data['category'] = Category::get();
            $data['menu'] = Category::get();
    
            $data['cat_id'] = $category['id'];
    
            return view('pages.dashboard.dynamic_menu', $data);
        }
    }

    public function view_pdf($file){
        $data['file'] = 'storage/file/'.$file;        

        return view('pages.dashboard.partials._pdf_viewer', $data);
    }
}

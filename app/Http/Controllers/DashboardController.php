<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DashboardController extends Controller
{
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

    public function view_pdf($file){
        $data['file'] = 'storage/file/'.$file;        

        return view('pages.dashboard.partials._pdf_viewer', $data);
    }
}

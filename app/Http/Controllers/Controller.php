<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function index(){
        $data['title'] = 'Home';
        $data['active'] = 'home';
        $data['category'] = Category::get();

        $data['data'] = Helpers::getMenu();

        return view('pages.home', $data);
    }

    public function details($id){
        $data = Item::find($id);
        if($data){
            $data['title'] = $data['name'];
            $data['active'] = 'detail';
            $data['category'] = Category::get();
    
            $data['data'] = $data;
    
            return view('pages.details', $data);
        }
    }
}

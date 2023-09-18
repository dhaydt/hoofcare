<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $data['data'] = Category::whereHas('items', function($i){
            $i->where('is_public', 1)->orderBy('created_at', 'desc');
        })->get();

        return view('pages.home', $data);
    }
}

<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Models\Ads;
use App\Models\Category;
use App\Models\Flip;
use App\Models\Item;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function flipped($id){
        $data['title'] = 'Flipped';
        $data['active'] = 'flipped';
        $data['category'] = Category::get();

        $data['data'] = Flip::find($id);

        return view('pages.flipped', $data);
    }

    public function index(){
        $data['title'] = Helpers::getConfig('web_name');
        $data['email'] = Helpers::getConfig('email');
        $data['active'] = 'home';
        $data['category'] = Category::orderBy('name', 'asc')->get();

        $data['data'] = Helpers::getMenu();

        $data['iklan'] = Ads::where(['show_in' => 0, 'status' => 1])->orderBy('created_at', 'desc')->get();

        $data['iklanCat'] = Ads::where(['status' => 1])->orderBy('created_at', 'desc')->get()->groupBy('show_in');

        $counter = Category::orderBy('name', 'asc')->get();

        foreach($counter as $count){
            $count['counter'] = 0;
            foreach($count['items'] as $item){
                $commentable = count($item['commenting']);
                $count['counter'] += $commentable;
            }
        }
        $data['counter'] = $counter;
        return view('pages.home', $data);
    }
    
    public function privacy(){
        $data['title'] = 'Privacy Policy';
        $data['active'] = 'privacy';
        $data['category'] = Category::orderBy('name', 'asc')->get();

        $data['data'] = Helpers::getMenu();

        $data['iklan'] = Ads::where(['show_in' => 0, 'status' => 1])->orderBy('created_at', 'desc')->get();

        return view('pages.privacy_policy', $data);
    }
    
    public function contact(){
        $data['title'] = 'Hoofpedia Contacts';
        $data['active'] = 'contact';
        $data['category'] = Category::orderBy('name', 'asc')->get();

        $data['data'] = Helpers::getMenu();

        // $data['iklan'] = Ads::where(['show_in' => 9998, 'status' => 1])->orderBy('created_at', 'desc')->get();

        return view('pages.contact', $data);
    }
    
    public function dynamic_menu($id){
        $cat = Category::find($id);
        $data['title'] = $cat['name'];
        $data['active'] = $cat['id'];
        $data['category'] = Category::get();

        $data['data'] = Item::where('category_id', $id)->orderBy('updated_at', 'desc')->get();

        $data['iklan'] = Ads::where(['show_in' => $id, 'status' => 1])->orderBy('created_at', 'desc')->get();

        return view('pages.menu_home', $data);
    }

    public function details($id){
        $data = Item::find($id);
        if($data){
            $data['title'] = $data['name'];
            $data['active'] = 'detail';
            $data['category'] = Category::orderBy('name', 'asc')->get();
    
            $data['data'] = $data;

            $data['iklan'] = Ads::where(['show_in' => 9999, 'status' => 1])->orderBy('created_at', 'desc')->get();
    
            return view('pages.details', $data);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.search');
    }
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $items = Item::where('name', 'LIKE', '%' . $request->search . "%")->orWhere('description', 'LIKE', '%' . $request->search . "%")->orderBy('name', 'asc')->get();
            $categories = Category::where('name', 'LIKE', '%' . $request->search . '%')->orderBy('name', 'asc')->get();
            if($categories){
                foreach ($categories as $k => $cat) {
                    $output .= '<div class="card mb-2" data-bs-toggle="tooltip" title="category">
                                    <a href="'.route('home_menu', [$cat->id, $cat->name]).'" class="card-header">
                                    '.$cat->name.'
                                    </a>
                                </div>';
                }
            }
            if ($items) {
                foreach ($items as $key => $i) {
                    $output .= '<div class="card p-2 flex-row item d-flex mb-2" data-bs-toggle="tooltip" title="item">
                    <div class="avatar d-flex align-items-center">
                        <img src="'.asset('storage/'.$i->pic1).'"onerror="this.src=`'.asset('assets/images/no_img.jpeg').'`"
                            height="60px" width="60px" alt="">
                    </div>
                    <div class="ms-3 w-100 p-2">
                        <div class="title-item">
                        <a href="'. route('item.detail', [$i->id, $i->name]) .'">
                        <div class="d-flex justify-content-between"><span>'.$i->name.'</span> <span class="ms-auto">'.$i->category->name.'</span></div>
                        </a>
                        <span class="description">'.$i->description.'</span>
                        </div>
                    </div>
                    </div>';
                }
                return Response($output);
            }
        }
    }
}

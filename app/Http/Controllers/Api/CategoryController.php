<?php

namespace App\Http\Controllers\Api;

use App\CPU\Helpers;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategory(){
        $data = Category::get();

        return response()->json(Helpers::response_format(200, true, "success", [$data]));
    }
}

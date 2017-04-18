<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class Categories extends Controller
{
    public function index() {

    	$categories = Category::select('categories.categoria_id','categories.codiCategoria','categories.nomCategoria')
    	->where('deleted','=', null)->orWhere('deleted','=', 0)->get();

    	return response()->json([
                'categories' => $categories
            ]);
    }
}

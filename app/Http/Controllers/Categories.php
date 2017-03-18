<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class Categories extends Controller
{
    public function index() {

    	$categories = Category::select('categories.codiCategoria','categories.nomCategoria')->get();

    	return response()->json([
                'categories' => $categories
            ]);
    }
}

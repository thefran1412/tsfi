<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;

class Categories extends Controller
{
     protected $loginPath = '/admin/login';  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
    	$c = Category::All();
        return view('backend.recursos.categories', ['categories' => $c]);
    }

    public function store(Request $request)
    {
        \App\Category::Create([
            'nomCategoria' => $request['nom'],
            'codiCategoria' => $request['codi'],
            'descCategoria' => $request['desc']
        ]);
        return redirect('admin/categories');
    }

    public function destroy($id)
    {
        \App\Category::destroy($id);
        return redirect('admin/categories');
        
    }
}

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
        return view('backend.categories.index', ['categories' => $c]);
    }

    public function store(Request $request)
    {
        $this->validateTag($request);

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

    public function edit($id = NULL)
    {
        if ($id == NULL) {
            return redirect('admin/categories');
        }
        $c = Category::find($id);
        return view('backend.categories.edit',  ['categoria' => $c]);
    }
    public function update($id, Request $request)
    {
        $this->validateTag($request);

        $recurs = Category::find($id);
        $recurs->fill($request->all());
        $recurs->save();
        return redirect('admin/categories');
    }
    private function validateCategory($request)
    {
        $this->validate($request, [
            'nomCategoria' => 'required|max:70',
            'descCategoria' => 'required|max:70',
        ]);
    }
}

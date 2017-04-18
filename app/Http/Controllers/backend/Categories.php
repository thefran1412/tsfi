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
    	$c = Category::All()->where('deleted', '!=', 1);
        return view('backend.categories.index', ['categories' => $c]);
    }

    public function store(Request $request)
    {
        $check = Category::
            where('nomCategoria', $request->nomCategoria)
            ->where('codiCategoria', $request->codiCategoria)
            ->where('deleted', '!=', 1)
            ->count();

        if ($check >= 1) {
            $this->validateCategory($request);
        }
        else{
            $this->validateCategories($request);
        }
        
        Category::Create([
            'nomCategoria' => $request['nomCategoria'],
            'codiCategoria' => $request['codiCategoria'],
            'descCategoria' => $request['descCategoria']
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
        $this->validateCategory($request);

        $recurs = Category::find($id);
        $recurs->fill($request->all());
        $recurs->save();
        return redirect('admin/categories');
    }
    private function validateCategory($request)
    {
        $this->validate($request, [
            'nomCategoria' => 'unique:categories,nomCategoria|required|max:70',
            'descCategoria' => 'required|max:70',
            'codiCategoria' => 'unique:categories,codiCategoria|required|max:70',
        ]);
    }
    private function validateCategories($request)
    {
        $this->validate($request, [
            'nomCategoria' => 'required|max:70',
            'descCategoria' => 'required|max:70',
            'codiCategoria' => 'required|max:70',
        ]);
    }
    public function soft($id)
    {
        $e = Category::where('categoria_id', $id)->first();
        $e->deleted = 1;
        $e->save();

        return redirect('admin/categories');
    }
}

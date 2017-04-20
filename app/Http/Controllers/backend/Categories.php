<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\CategoryResource;

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
            ->where('deleted', 0)
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
            'descCategoria' => $request['descCategoria'],
            'deleted' => 0,
        ]);
        
        return redirect('admin/categories');
    }

    public function destroy($id)
    {
        $e = Category::where('categoria_id', $id)->first();
        $e->deleted = 1;
        $e->save();

        // change relationship with resources
        $cr = CategoryResource::where('idCategoria', $id)->get();

        foreach ($cr as $resource) {
            $resource->idCategoria = 1;
            $resource->save();
        }

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
        $check = Category::
            where('nomCategoria', $request->nomCategoria)
            ->where('deleted', 0)
            ->first();
        
        if ($check != null && $id != $check->categoria_id) {
            $this->validateCategory($request);
        }
        else{
            $this->validateCategories($request);
        }

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
            'codiCategoria' => 'required|max:70',
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
}

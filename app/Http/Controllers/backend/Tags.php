<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;

class Tags extends Controller
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
        $c = Tag::All();
        return view('backend.tags.index', ['tags' => $c]);
    }

    public function store(Request $request)
    {
        \App\Tag::Create([
            'nomTags' => $request['nom'],
            'descTag' => $request['desc']
        ]);
        return redirect('admin/tags');
    }

    public function destroy($id)
    {
        \App\Tag::destroy($id);
        return redirect('admin/tags');

    }

    public function edit($id = NULL)
    {
        if ($id == NULL) {
            return redirect('admin/tags');
        }
        $c = Tag::find($id);
        return view('backend.tags.edit',  ['tag' => $c]);
    }
    public function update($id, Request $request)
    {
        $recurs = Tag::find($id);
        $recurs->fill($request->all());
        $recurs->save();
        return redirect('admin/tags');
    }
}

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
        $c = Tag::All()->where('deleted', '!=', 1);
        return view('backend.tags.index', ['tags' => $c]);
    }

    public function store(Request $request)
    {
        $this->validateTag($request);

        \App\Tag::Create([
            'nomTags' => $request['nomTags']
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
        $this->validateTag($request);
        $recurs = Tag::find($id);
        $recurs->fill($request->all());
        $recurs->save();
        return redirect('admin/tags');
    }
    private function validateTag($request)
    {
        $this->validate($request, [
            'nomTags' => 'unique:tags,nomTags|required|max:70',
        ]);
        
        // var_dump($request->nomTags);
        // $c = Tag::where('nomTags', $request->nomTags)->first();

        // if ($c != null && $) {
        // }
    }
    public function soft($id)
    {
        $e = Tag::where('tags_id', $id)->first();
        $e->deleted = 1;
        $e->save();

        return redirect('admin/tags');
    }
}

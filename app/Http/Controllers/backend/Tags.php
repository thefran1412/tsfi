<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\TagResource;

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
        $check = Tag::
            where('nomTags', $request->nomTags)
            ->where('deleted', 0)
            ->count();

        if ($check >= 1) {
            $this->validateTag($request);
        }
        else{
            $this->validateTags($request);
        }

        Tag::Create([
            'nomTags' => $request['nomTags'],
            'deleted' => 0,
        ]);
        return redirect('admin/tags');
    }

    public function destroy($id)
    {
        $e = Tag::where('tags_id', $id)->first();
        $e->deleted = 1;
        $e->save();

        // delete relationship with resources
        $tr = TagResource::where('idTag', $id)->delete();


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
        $check = Tag::
            where('nomTags', $request->nomTags)
            ->where('deleted', 0)
            ->first();
        
        if ($check != null && $id != $check->tags_id) {
            $this->validateTag($request);
        }
        else{
            $this->validateTags($request);
        }

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
    }
    private function validateTags($request)
    {
        $this->validate($request, [
            'nomTags' => 'required|max:70',
        ]);
    }
    public function soft($id)
    {
        $e = Tag::where('tags_id', $id)->first();
        $e->deleted = 1;
        $e->save();

        return redirect('admin/tags');
    }
}

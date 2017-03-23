<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity;

class Entitats extends Controller
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
        $c = Entity::All();
        return view('backend.entitats.index', ['entitats' => $c]);
    }

    public function show()
    {
        return view('backend.entitats.add');
    }

    public function store(Request $request)
    {
        $this->validateEntity($request);
        
            \App\Entity::Create([
                'nomEntitat' => $request['nom'],
                'descEntitat' => $request['desc']
            ]);
            return redirect('admin/entitats');

    }

    public function destroy($id)
    {
        \App\Entity::destroy($id);
        return redirect('admin/entitats');

    }

    public function edit($id = NULL)
    {
        if ($id == NULL) {
            return redirect('admin/entitats');
        }
        $c = Entity::find($id);
        return view('backend.entitats.edit',  ['entitat' => $c]);
    }

    public function update($id, Request $request)
    {
        $recurs = Entity::find($id);
        $recurs->fill($request->all());
        $recurs->save();
        return redirect('admin/entitats');
    }
    private function validateEntity($request)
    {
        $this->validate($request, [
            'nom' => 'required|max:255',
            
            'telf1' => 'required|min:9|max:9',
            'telf2' => 'min:9|max:9',
                        
            'link' => 'url|max:255',
            'facebook' => 'url|max:255',
            'twitter' => 'url|max:255',
            'instagram' => 'url|max:255',

            'logo' => 'required',
            'adreca' => 'max:255',
        ]);
    }
}
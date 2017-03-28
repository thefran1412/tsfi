<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Validators\ImageValidator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity;

class Entitats extends Controller
{
    protected $loginPath = '/admin/login';
    protected $logo;
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
        //$this->validateEntity($request);
        //$request['logo'] = '/hola/';
        var_dump($request->hasFile('logo'));
        
        if ($request->hasFile('logo')) {
            
            $validateimage = new ImageValidator($request, 'logo');
            
            if ($validateimage->validateImage(null, 2000000)){
                
                $validateimage->saveImage();
                $this->logo = $validateimage->getPublicDir();
            
            }else{
                
                $validateimage->errorUpoad();
            }
        }else{
            
            $this->logo = '/images/default.jpg';
        }
        \App\Entity::Create([
            'nomEntitat' =>  setDefaults($request, 'nomEntitat', 'entitats'),
            'descEntitat' =>  setDefaults($request, 'descEntitat', 'entitats'),
            
            'telf1' =>  setDefaults($request, 'telf1', 'entitats'),
            'telf2' =>  setDefaults($request, 'telf2', 'entitats'),
            'link' =>  setDefaults($request, 'link', 'entitats'),
            
            'esMembre' => setDefaults($request, 'esMembre', 'entitats'),
            
            'logo' => $this->logo,
            'idLocalitzacio' => null,

            'facebook' =>  setDefaults($request, 'facebook', 'entitats'),
            'twitter' =>  setDefaults($request, 'twitter', 'entitats'),
            'instagram' =>  setDefaults($request, 'instagram', 'entitats'),

            'adreca' => $request['adreca'],
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
            'nomEntitat' => 'required|max:255',
            'descEntitat' => 'required|max:255',

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
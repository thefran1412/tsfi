<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Validators\ImageValidator;
use App\Http\Controllers\Validators\MapValidator;
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
        $c = Entity::All()->where('deleted', '!=', 1);
        return view('backend.entitats.index', ['entitats' => $c]);
    }

    public function show()
    {
        return view('backend.entitats.add');
    }

    public function store(Request $request)
    {
        $this->validateEntity($request);
        
        //validate and save map
        $validatemap = new MapValidator($request['lat'], $request['lng']);
        $locId = $validatemap->saveMap();
        if ($locId == null) {
            $request['adreca'] = null;
        }

        if ($request->hasFile('logo')) {
            
            $validateimage = new ImageValidator($request, 'logo');
            
            if ($validateimage->validateImage(null, 2000000)){
                $validateimage->saveImage();
                $this->logo = $validateimage->getNewImagePath();
            }else{
                
                $validateimage->errorUpload();
            }
        }else{
            
            $this->logo = 'default.png';
        }

        \App\Entity::Create([
            'nomEntitat' =>  setDefaults($request, 'nomEntitat', 'entitats'),
            'descEntitat' =>  setDefaults($request, 'descEntitat', 'entitats'),
            
            'telf1' =>  setDefaults($request, 'telf1', 'entitats'),
            'telf2' =>  setDefaults($request, 'telf2', 'entitats'),
            'link' =>  setDefaults($request, 'link', 'entitats'),
            
            'esMembre' => setDefaults($request, 'esMembre', 'entitats'),
            
            'logo' => $this->logo,
            'idLocalitzacio' => $locId,

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
        $location = \App\Location::find($c->idLocalitzacio);
        // var_dump($location);
        
        return view('backend.entitats.edit',  ['entitat' => $c, 'location' => $location]);
    }

    public function update($id, Request $request)
    {
        
        //valida els camps
        $this->validateEntity($request);
        //agafa la info de l'entitat
        $recurs = Entity::find($id);
        
        /* VALIDACIÓ MAPA */
        
        $validatemap = new MapValidator($request['lat'], $request['lng']);
        //guarda la localització del mapa i torna l'id
        $locId = $validatemap->saveMap();
        
        //en cas que no hi hagi valors de longitud i latitud la adreça es posa a null
        if ($locId == null) {
            $request['adreca'] = null;
        }
        
        /* VALIDACIÓ IMATGE */
        
        if ($request->hasFile('logo')) {
            
            $validateimage = new ImageValidator($request, 'logo');
            
            //valida que la imatge sigui correcte
            if ($validateimage->validateImage(null, 2000000)){
                $validateimage->saveImage();
                $this->logo = $validateimage->getNewImagePath();
            }else{
                
                $validateimage->errorUpload();
            }
        }else{
            //si no hi ha cap arxiu nou, posa el valor que ja hi havia a la base de dades
            $this->logo = $recurs->logo;
        }

        $recurs->fill($request->all());

        //make sure all empty values = null;
        $recurs->esMembre =setDefaults($request, 'esMembre', 'entitats');

        $recurs->nomEntitat = setDefaults($request, 'nomEntitat', 'entitats');
        $recurs->descEntitat = setDefaults($request, 'descEntitat', 'entitats');
        
        $recurs->telf1 = setDefaults($request, 'telf1', 'entitats');
        $recurs->telf2 = setDefaults($request, 'telf2', 'entitats');
        $recurs->link = setDefaults($request, 'link', 'entitats');
        

        if ($request['esMembre'] == 'true') {
            $request['esMembre'] = 1;
        }
        else{
            $request['esMembre'] = 0;   
        }
        
        $recurs->esMembre = $request['esMembre'];
        
        $recurs->logo = $this->logo;
        $recurs->idLocalitzacio = $locId;

        $recurs->facebook = setDefaults($request, 'facebook', 'entitats');
        $recurs->twitter = setDefaults($request, 'twitter', 'entitats');
        $recurs->instagram = setDefaults($request, 'instagram', 'entitats');

        $recurs->save();
        return redirect('admin/entitats');
    }
    private function validateEntity($request)
    {
        $this->validate($request, [
            'nomEntitat' => 'required|max:255',
            'descEntitat' => 'required|max:255',

            'telf1' => 'min:9|max:9',
            'telf2' => 'min:9|max:9',
                        
            'link' => 'url|max:255',
            'facebook' => 'url|max:255',
            'twitter' => 'url|max:255',
            'instagram' => 'url|max:255',

            'adreca' => 'max:255',
        ]);
    }
    public function soft($id)
    {
        $e = Entity::where('entitat_id', $id)->first();
        $e->deleted = 1;
        $e->save();

        return redirect('admin/entitats');
    }
}
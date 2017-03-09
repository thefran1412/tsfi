<?php

namespace App\Http\Controllers\backend;

use App\Resource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Recursos extends Controller
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
        $recursos = Resource::All();
		return view('backend.recursos.index', compact('recursos'));
	}
	public function storeResource()
	{

//        $this->validate(request(), [
//            'note' => ['required', 'max:200']
//        ]);
        $data = request()->only(['note']);
        Resource::create($data);

        return redirect()->to('notes');
//		return view('backend.recursos.add');
	}
    public function listRecurso()
    {

        $recursos=Resource::paginate(10);
//        dd($recursos);
        $page = ["page" => "listresources"];
        return view('backend.recursos.listResources',compact('recursos'));
//        return view('backend.recursos.listResources',compact('recursos'))->with(["page" => "listresources"]);
    }
}

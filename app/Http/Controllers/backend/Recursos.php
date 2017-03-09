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
	public function add()
	{
		return view('backend.recursos.add');
	}
    public function listRecurso()
    {

        $recursos=Recursos::paginate(10);
//        dd($recursos);
        $page = ["page" => "listresources"];
        return view('backend.recursos.listResources',compact('recursos'))->with(["page" => "listresources"]);
    }
}

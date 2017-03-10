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
		return view('backend.recursos.index');
	}
	public function add()
	{
		return view('backend.recursos.add');
    }
	public function store()
	{
        $data = request()->only(['autor']);
        Resource::create($data);
        return redirect()->to('notes');
	}
}

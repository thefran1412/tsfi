<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Usuaris extends Controller
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
	    $usuari = User::all()->first();
		return view('backend.usuaris.index', [
		    'usuari' => $usuari
        ]);
	}
	public function add()
	{
		return view('backend.usuaris.add');
	}
	public function update($id, Request $request)
	{
        dump($id);
        if ($request[''])
        $user = User::where([''])->first();
	    exit();
        return redirect('admin/configuracio/usuari');
	}
}

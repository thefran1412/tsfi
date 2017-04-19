<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        $user = User::where(['id'=> $id])->first();
        $user->name = $request['user'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        if ($request['remember']){
            $user->remember_token = bcrypt($request['remember']);
        }
        $user->save();
        return redirect('admin/configuracio/usuari');
	}
}

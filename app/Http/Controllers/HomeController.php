<?php

namespace App\Http\Controllers;

use App\Recursos;
use Illuminate\Http\Request;

class HomeController extends Controller
{
//     protected $loginPath = '/admin/login';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    // public function index()
    // {
    //     return view('home');
    // }

    public function index()
    {
        return view('backend.dashboard');
    }
    public function resource()
    {
        return view('backend.addresource');
    }
    public function listResource()
    {
        $recursos = Recursos::paginate(10);


        return view('backend.listResources', compact('recursos'));
    }

}

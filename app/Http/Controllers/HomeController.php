<?php

namespace App\Http\Controllers;

use App\Recursos;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

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
        $page = "addresource";
        return view("backend.addresource")->with(["page" => "addresource"]);
    }
    public function listResource()
    {

        $recursos=Recursos::paginate(10);
//        dd($recursos);
        $page = ["page" => "listresources"];
        return view('backend.listResources', compact('recursos'))->with(["page" => "listresources"]);
    }
    public function storeResource()
    {
        $data = request()->only(['titol', 'subTitol', 'descDetaill1', 'creatPer']);
        Recursos::create($data);

        return redirect()->to('resource/list');
    }
}

<?php

namespace App\Http\Controllers\backend;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Backend extends Controller
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
        $views = 0;
        return view('backend.dashboard', ['views' => $views]);
    }

    public function resource()
    {
        return view('backend.addresource');
    }
    public function config()
    {
        $users = User::all()->first();

        return view('backend.config', ['users'=> $users]);
    }
//return view('backend.recursos.edit',[
    //'edats'=>$edats,
    //'categorias'=>$categorias,
    //'entitats'=>$entitats,
    //'targets'=>$targets,
    //'selectedtarget'=>$selectedtarget,
    //'selectedCategoria'=>$selectedCategoria,
    //'selectedEntitat'=>$selectedEntitat,
    //'arrayedats'=>$arrayedats,
    //'id'=>$id,
    //'recurso'=>$recurso,
    //'selectedTags'=>$selectedTags,
    //'video_recurs'=>$video_recurs,
    //'image_recurs'=>$image_recurs,
    //'podcast_recurs'=>$podcast_recurs,
    //'selectedLinks'=>$selectedLinks
    //]
//);
}
<?php

namespace App\Http\Controllers\backend;

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
        return view('backend.config');
    }
}
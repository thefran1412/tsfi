<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Entitats extends Controller
{
    public function index()
    {
    	return view('backend.entitats.index');
    }
    public function add()
    {
    	return view('backend.entitats.add');
    }
}

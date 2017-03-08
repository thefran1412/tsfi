<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Recursos extends Controller
{
    public function index()
    {
    	return view('backend.recursos');
    }
}

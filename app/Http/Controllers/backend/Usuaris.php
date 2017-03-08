<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Usuaris extends Controller
{
	public function index()
	{
		return view('backend.usuaris.index');
	}
	public function add()
	{
		return view('backend.usuaris.add');
	}
}

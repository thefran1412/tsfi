<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;


class Entitats extends Controller
{
    public function index() {

    	$entities = Entity::select('entitats.nomEntitat','entitats.link')->get();

    	return response()->json([
                'entities' => $entities
            ]);
    }
}

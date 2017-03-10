<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;


class Recursos extends Controller
{
    public function index() {

	// $resources = Resource::all();
    	$resources = Resource::join("categoria_recurs","categoria_recurs.id","=","recursos.idRecurs")
    	->get();

	return response()->json([
            'resources' => $resources
        ]);
    }

}

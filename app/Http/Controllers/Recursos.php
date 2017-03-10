<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Recursos extends Controller
{
    public function index() {

    	$resources = \App\Resource::join("categoria_recurs as cr","cr.idRecurs","=","recursos.id")
    	->join("categories as c","c.id","=","cr.idCategoria")
    	->select("recursos.id","recursos.titol","recursos.subTitol","recursos.creatPer","recursos.dataPublicacio","recursos.fotoResum","c.nom")
    	->get();

	return response()->json([
            'resources' => $resources
        ]);
    }

}

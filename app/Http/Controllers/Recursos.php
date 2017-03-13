<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Recursos extends Controller
{
    public function index(Request $request, $typeuser) {

    	$resources = \App\Resource::join("categoria_recurs as cr","cr.idRecurs","=","recursos.id")
    	->join("categories as c","c.id","=","cr.idCategoria")
        ->join("entitat_recurs as er", "er.idRecurs", "=", "recursos.id")
        ->join("entitats as e", "er.idEntitat", "=", "e.id")
        ->join("target_recurs", "target_recurs.idRecurs", "=", "recursos.id")
        ->join("targets","targets.id","=","target_recurs.idTarget")
    	->select("recursos.id","recursos.titol","recursos.subTitol","recursos.creatPer","recursos.dataPublicacio","recursos.fotoResum","c.nomCategoria","e.nomEntitat", "targets.codi")
    	->where("targets.codi","=", $typeuser)
        ->get();

	return response()->json([
            'resources' => $resources
        ]);
    }

 	public function getResource() {

	// $resources = Resource::all();
    	$resources = Resource::join("categoria_recurs","categoria_recurs.idRecurs","=","recursos.id")
    	->get();

	return response()->json([
            'resources' => $resources
        ]);
    }
}

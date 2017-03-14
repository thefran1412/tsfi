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
        ->join("entitat_recurs as er", "er.idRecurs", "=", "recursos.id")
        ->join("entitats as e", "er.idEntitat", "=", "e.id")
    	->select("recursos.id","recursos.titol","recursos.subTitol","recursos.creatPer","recursos.dataPublicacio","recursos.fotoResum","c.nomCategoria","e.nomEntitat")
    	->get();

	return response()->json([
            'resources' => $resources
        ]);
    }

 	public function getResource(Request $request, $id) {
        // $resources = Resource::findOrFail($id);
	// $resources = Resource::all();
    	$resources = Resource::join("categoria_recurs as cr","cr.idRecurs","=","recursos.id")
        ->join("categories as c","c.id","=","cr.idCategoria")
        ->join("entitat_recurs as er", "er.idRecurs", "=", "recursos.id")
        ->join("entitats as e", "er.idEntitat", "=", "e.id")
        ->join("link_recurs as lr","lr.id","=","recursos.id")
        ->join("imatge_recurs as ir","ir.id","=","recursos.id")
        ->join("podcasts as po","po.id","=","recursos.id")
        ->join("video_recurs as vr","vr.idRecurs","=","recursos.id")
        ->join("tipus_videos as tv","tv.id","=","vr.idTipus")
        ->join("edats_recurs as edr","edr.idRecurs","=","recursos.id")
        ->join("edats as ed","ed.id","=","edr.idEdat")
        ->where("recursos.id","=",$id)
        ->select("recursos.titol")
         ->get();

	return response()->json([
            'resources' => $resources
        ]);
    }
}

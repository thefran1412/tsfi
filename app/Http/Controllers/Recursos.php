<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class Recursos extends Controller
{
    public function index(Request $request, $typeuser) {

    	$resources = \App\Resource::join("categoria_recurs as cr","cr.idRecurs","=","recursos.recurs_id")
    	->join("categories as c","c.categoria_id","=","cr.idCategoria")
        ->join("entitat_recurs as er", "er.idRecurs", "=", "recursos.recurs_id")
        ->join("entitats as e", "er.idEntitat", "=", "e.entitat_id")
        ->join("target_recurs", "target_recurs.idRecurs", "=", "recursos.recurs_id")
        ->join("targets","targets.targets_id","=","target_recurs.idTarget")
    	->select("recursos.recurs_id","recursos.titolRecurs","recursos.subTitol","recursos.creatPer","recursos.dataPublicacio","recursos.fotoResum","c.nomCategoria","e.nomEntitat", "targets.codiTarget")
    	//->where("targets.codiTarget","=", $typeuser)
        // ->where("c.nomCategoria","like","%%")
        ->where("c.nomCategoria","=",$typeuser)
        ->get();

	return response()->json([
            'resources' => $resources
        ]);
    }

 	public function getResource(Request $request, $id) {
        // $resources = Resource::findOrFail($id);
    	$resource = \App\Resource::join("categoria_recurs as cr","cr.idRecurs","=","recursos.recurs_id")
        ->join("categories as c","c.categoria_id","=","cr.idCategoria")
        ->join("entitat_recurs as er", "er.idRecurs", "=", "recursos.recurs_id")
        ->join("entitats as e", "er.idEntitat", "=", "e.entitat_id")
        ->join("target_recurs", "target_recurs.idRecurs", "=", "recursos.recurs_id")
        ->join("targets","targets.targets_id","=","target_recurs.idTarget")
        ->join("edats_recurs","edats_recurs.idRecurs","=","recursos.recurs_id")
        ->join("edats","edats_recurs.idEdat","=","edats.edats_id")
        ->join("video_recurs","video_recurs.idRecurs","=","recursos.recurs_id")
        ->join("localitzacions","localitzacions.localitzacions_id","=","recursos.idLocalitzacio")
        ->join("imatge_recurs","imatge_recurs.idRecurs","=","recursos.recurs_id")
        ->join("podcasts","podcasts.idRecurs","=","recursos.recurs_id")
        ->select("recursos.recurs_id","recursos.titolRecurs","recursos.subTitol","recursos.creatPer","recursos.dataPublicacio","recursos.fotoResum","c.nomCategoria","e.nomEntitat","targets.codiTarget","edats.codiEdat","edats.descEdat","video_recurs.urlVideo","localitzacions.latitud","localitzacions.longitud", "imatge_recurs.descImatge", "podcasts.descPodCasts")
        ->where("recursos.recurs_id","=", $id)
        ->get();


	return response()->json([
            'resource' => $resource
        ]);
    }
}

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
    	->where("targets.codiTarget","=", $typeuser)
        ->get();

	return response()->json([
            'resources' => $resources
        ]);
    }

 	public function getResource(Request $request, $id) {
        // $resources = Resource::findOrFail($id);
    	$resource = \App\Resource::join("localitzacions as lo","lo.localitzacions_id","=","recursos.idLocalitzacio")
        ->select
        ("recursos.recurs_id",
            "recursos.creatPer",
            "recursos.dataFinal",
            "recursos.dataInici",
            "recursos.dataPublicacio",
            "recursos.descBreu",
            "recursos.descDetaill1",
            "recursos.descDetaill2",
            "recursos.fotoResum",
            "recursos.gratuit",
            "recursos.preuInferior",
            "recursos.preuSuperior",
            "recursos.relevancia",
            "recursos.subtitol",
            "recursos.titolRecurs",
            "lo.latitud",
            "lo.longitud")
        ->where("recursos.recurs_id","=", $id)
        ->get();

        $link = \App\Link::join("recursos as re","re.recurs_id","=","link_recurs.idRecurs")
        ->select("link_recurs.link")
        ->where("re.recurs_id","=", $id)
        ->get();

        $imatge = \App\ImageResource::join("recursos as re","re.recurs_id","=","imatge_recurs.idRecurs")
        ->select("imatge_recurs.imatge")
        ->where("re.recurs_id","=", $id)
        ->get();

        $podcasts = \App\Podcast::join("recursos as re","re.recurs_id","=","podcasts.idRecurs")
        ->select("podcasts.podCast")
        ->where("re.recurs_id","=", $id)
        ->get();

        $video = \App\VideoResource::join("recursos as re","re.recurs_id","=","video_recurs.idRecurs")
        ->join("tipus_videos as tvi","tvi.tipus_videos_id","=","video_recurs.idTipus")
        ->select("video_recurs.urlVideo",
            "video_recurs.titolVideoRecurs",
            "tvi.plataforma")
        ->where("re.recurs_id","=", $id)
        ->get();

        $ages = \App\AgeResource::join("recursos as re","re.recurs_id","=","edats_recurs.idRecurs")
        ->join("edats","edats.edats_id","=","edats_recurs.idEdat")
        ->select("edats.codiEdat",
            "edats.descEdat")
        ->where("re.recurs_id","=", $id)
        ->orderby("edats.edats_id")
        ->get();


	return response()->json([
            'resource'  => $resource,
            'link'      => $link,
            'imatge'    => $imatge,
            'podcasts'  => $podcasts,
            'video'     => $video,
            'ages'      => $ages
        ]);
    }
}

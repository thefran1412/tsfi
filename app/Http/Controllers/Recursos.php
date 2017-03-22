<?php
namespace App\Http\Controllers;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Entity;
class Recursos extends Controller
{
    public function index(Request $request, $typeuser, $category) {

        if($category === 'home'){
            $category = '%';
        }

        $resources = Resource::with('category','targets','entity')->
            whereHas('targets', function ($query) use ($typeuser) {
                    $query->where('codiTarget','=', $typeuser);
            })->whereHas('category', function ($query) use ($category) {
                    $query->where('nomCategoria','LIKE', $category);
            })->paginate(20)->items();

        return response()->json([
                'resources' => $resources
            ]);
    }
    public function getResource(Request $request, $id) {
        $resource = Resource::with('location')
            ->where("recursos.recurs_id","=", $id)
            ->get();
        // $resources = Resource::findOrFail($id);
        // $resource = \App\Resource::join("localitzacions as lo","lo.localitzacions_id","=","recursos.idLocalitzacio")
     //    ->select
     //    ("recursos.recurs_id",
     //        "recursos.creatPer",
     //        "recursos.dataFinal",
     //        "recursos.dataInici",
     //        "recursos.dataPublicacio",
     //        "recursos.descBreu",
     //        "recursos.descDetaill1",
     //        "recursos.descDetaill2",
     //        "recursos.fotoResum",
     //        "recursos.gratuit",
     //        "recursos.preuInferior",
     //        "recursos.preuSuperior",
     //        "recursos.relevancia",
     //        "recursos.subtitol",
     //        "recursos.titolRecurs",
     //        "lo.latitud",
     //        "lo.longitud")
     //    ->where("recursos.recurs_id","=", $id)
     //    ->get();
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
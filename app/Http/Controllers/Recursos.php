<?php
namespace App\Http\Controllers;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// use App\Entity;
class Recursos extends Controller
{
    public function index(Request $request, $typeuser, $category) {

        if($category === 'home'){
            $category = '%';
        }

        $resources = Resource::where('visible', '=', 1)->with('category','targets','entity')->
            whereHas('targets', function ($query) use ($typeuser) {
                    $query->where('codiTarget','=', $typeuser)->orWhere('targets_id','=', 3);
            })->whereHas('category', function ($query) use ($category) {
                    $query->where('nomCategoria','LIKE', $category);
            })->orderBy('dataPublicacio', 'des')->paginate(20)->items();


        return response()->json([
                'resources' => $resources
            ]);
    }

    public function getResultSearch(Request $request) {


        if(isset($_GET["name"])){
            $searchName = $_GET["name"];

            $tags = \App\Tag::where("nomTags","LIKE", "%$searchName%")
            ->where('deleted','=', null)->orWhere('deleted','=', 0)->get();

            $totalCount = Resource::where('visible', '=', 1)->with('entity','category')->
            whereHas('category', function ($query) use ($request) {
                    $query->where('deleted','=', 0)->orWhere('deleted','=', null);;
            })->where("titolRecurs","LIKE", "%$searchName%")->count();


            $resources = Resource::where('visible', '=', 1)->with('category','entity')->
            whereHas('category', function ($query) use ($request) {
                    $query->where('deleted','=', 0)->orWhere('deleted','=', null);;
            })->where("titolRecurs","LIKE", "%$searchName%")->
            orderBy('dataPublicacio', 'des')->paginate(20)->items();

            return response()->json([
                'resources' => $resources,
                'tags' => $tags,
                'totalCount' => $totalCount
            ]);
        }

        if(isset($_GET["tag"])){
            $searchTag = $_GET["tag"];

            $totalCount = Resource::where('visible', '=', 1)->with('tag')->
            whereHas('tag', function ($query) use ($searchTag) {
                    $query->where('tags_id','=', $searchTag);
            })->count();

            //$tagsSearch = \App\Tag::with('resource')->where("tags_id","=", $searchTag)->paginate(20)->items();

            $resources = Resource::where('visible', '=', 1)->with('tag')->
            whereHas('tag', function ($query) use ($searchTag) {
                    $query->where('tags_id','=', $searchTag);
            })->orderBy('dataPublicacio', 'des')->paginate(20)->items();

            return response()->json([
                'resources' => $resources,
                'totalCount' => $totalCount
            ]);
        }

    }


    public function getResource(Request $request, $id) {
        $resource = Resource::where('recursos.recurs_id','=', $id)->with('category',
                                    'age',
                                    'entity',
                                    'imageResource',
                                    'link',
                                    'location',
                                    'podcast',
                                    'tag',
                                    'targets',
                                    'videoResource',
                                    'videoType')->get();

        if($resource[0]->dataInici){
            $dateIni = $resource[0]->dataInici->format('d/m/Y');
        }
        else {
             $dateIni = null;
        }
        if($resource[0]->dataFinal){
            $dateEnd = $resource[0]->dataFinal->format('d/m/Y');
        }
        else {
             $dateEnd = null;
        }
        if($resource[0]->dataPublicacio){
            $datePub = $resource[0]->dataPublicacio->format('d/m/Y');
        }
        else {
             $datePub = null;
        }
        //var_dump($resource)
    return response()->json([
            'resource'  => $resource,
            'dateIni' => $dateIni,
            'dateEnd' => $dateEnd,
            'datePub' => $datePub
        ]);
    }
}

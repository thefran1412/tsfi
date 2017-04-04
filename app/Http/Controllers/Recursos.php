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
                    $query->where('codiTarget','=', $typeuser);
            })->whereHas('category', function ($query) use ($category) {
                    $query->where('nomCategoria','LIKE', $category);
            })->paginate(20)->items();

        return response()->json([
                'resources' => $resources
            ]);
    }

    public function getResultSearch(Request $request) {


        if(isset($_GET["name"])){
            $searchName = $_GET["name"];

            $tags = \App\Tag::where("nomTags","LIKE", "%$searchName%")->get();

            $totalCount = Resource::where('visible', '=', 1)->with('entity')->
            where("titolRecurs","LIKE", "%$searchName%")->count();


            $resources = Resource::where('visible', '=', 1)->with('entity')->
            where("titolRecurs","LIKE", "%$searchName%")->paginate(20)->items();

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
            })->paginate(20)->items();

            return response()->json([
                'resources' => $resources,
                'totalCount' => $totalCount
            ]);
        }

    }


    public function getResource(Request $request, $id) {
        $resource = Resource::with('category',
                                    'age',
                                    'entity',
                                    'imageResource',
                                    'link',
                                    'location',
                                    'podcast',
                                    'tag',
                                    'targets',
                                    'videoResource',
                                    'videoType')
            ->where('recursos.recurs_id','=', $id)
            ->get();

        // $dateIni = Carbon::now();;
        // $dateEnd = $dateIni;
        // $datePub = $dateIni;
        //var_dump($resource)
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

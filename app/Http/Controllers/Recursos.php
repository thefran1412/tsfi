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

    public function getResultSearch(Request $request) {


        if(isset($_GET["name"])){
            $searchName = $_GET["name"];

            $tags = \App\Tag::where("nomTags","LIKE", "%$searchName%")->get();

            $resources = Resource::with('entity')->
            where("titolRecurs","LIKE", "%$searchName%")->paginate(20)->items();

            return response()->json([
                'resources' => $resources,
                'tags' => $tags
            ]);
        }

        if(isset($_GET["tag"])){
            $searchTag = $_GET["tag"];

            //$tagsSearch = \App\Tag::with('resource')->where("tags_id","=", $searchTag)->paginate(20)->items();

            $resources = Resource::with('tag')->
            whereHas('tag', function ($query) use ($searchTag) {
                    $query->where('tags_id','=', $searchTag);
            })->paginate(20)->items();

            return response()->json([
                'resources' => $resources
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

        // $socialMedia = \App\Entity::with('socialMedia','resource')
        //     ->whereHas('resource', function ($query) use ($id) {
        //                 $query->where('idRecurs','=', $id);
        //         })
        //     ->get();

        // $dateIni = Carbon::now();;
        // $dateEnd = $dateIni;
        // $datePub = $dateIni;
        //var_dump($resource)
        $dateIni = $resource[0]->dataInici->format('d/m/Y');
        $dateEnd = $resource[0]->dataFinal->format('d/m/Y');
        $datePub = $resource[0]->dataPublicacio->format('d/m/Y');
        //var_dump($resource)
    return response()->json([
            'resource'  => $resource,
            'dateIni' => $dateIni,
            'dateEnd' => $dateEnd,
            'datePub' => $datePub
        ]);
    }
}

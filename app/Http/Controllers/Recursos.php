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
            })->get();

        return response()->json([
                'resources' => $resources
            ]);
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

        // $resource2 = Resource::with('entity')
        //     ->where('recursos.recurs_id','=', $id)
        //     ->get();

        // $idEntity = $resource[0].'entitats'.'entitat_id';
        $socialMedia = \App\Entity::with('socialMedia','resource')
            //->where("entitat_id","=","26")
            ->whereHas('resource', function ($query) use ($id) {
                        $query->where('idRecurs','=', $id);
                })
            ->get();


    return response()->json([
            // 'idEntity' => $idEntity,
            'resource'  => $resource,
            'socialMedia' => $socialMedia
        ]);
    }
}
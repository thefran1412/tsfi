<?php
namespace App\Http\Controllers;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        $dateIni = $resource[0]->dataInici->format('d/m/Y');
        $dateEnd = $resource[0]->dataFinal->format('d/m/Y');
        $datePub = $resource[0]->dataPublicacio->format('d/m/Y');

    return response()->json([
            'resource'  => $resource,
            'dateIni' => $dateIni,
            'dateEnd' => $dateEnd,
            'datePub' => $datePub
        ]);
    }
}

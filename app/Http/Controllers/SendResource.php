<?php

namespace App\Http\Controllers;

use App\Resource;
use App\ImageResource;
use App\TargetResource;
use App\TagResource;
use App\AgeResource;
use App\CategoryResource;
use App\Location;
use Illuminate\Http\Request;


class SendResource extends Controller
{
    public function submit(Request $request) {

	    $input = $request->only('titolRecurs','subTitol','descBreu','creatPer','descDetaill1', 'fotoResum');
		$selectCategory = $request->only('categoria');
		$selectTypeUser = $request->only('target');
		$selectAge = $request -> only('rangEdat');
		$location = $request->only('latitude','longitude');

		$sameLocation = Location::where('latitud', '=',$location['latitude'])
		->where('longitud', '=',$location['longitude'])->get();

		$loc = $sameLocation->toJson();
		$data = json_decode($loc);


		if($file = $request->file('image')){
			$name = time() . $file->getClientOriginalName();
			$string1 = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '', $name);
			$string = preg_replace('/\s*\([^)]*\)/', '', $string1);
			$file->move('img/image',$string);
			$input['fotoResum'] = $string;
		}

		$lastID = Resource::create($input);
		$insertedId = $lastID->recurs_id;

		$resource = Resource::find($insertedId);
		
		if(count($data) > 0){
			if($data[0]->localitzacions_id){
				$resource->idLocalitzacio = $data[0]->localitzacions_id;
			}
		}

		if($location['latitude'] !== '' && $location['longitude'] !== '' && count($data) === 0){
			$lastLocation = Location::create(['latitud' => $location['latitude'], 'longitud' => $location['longitude']]);
			$insertLocation = $lastLocation -> localitzacions_id;
			$resource->idLocalitzacio = $insertLocation;
		}

		if(isset($_GET["date"])){
			$resource->dataPublicacio = $_GET["date"];
		}

		if($price = $request->only('preuInferior')){
			if($price['preuInferior'] === '' || $price['preuInferior'] === 0 || $price['preuInferior'] === 0.0 || $price['preuInferior'] === 0.00){
				$resource->gratuit = 1;
			}else{
				$resource->gratuit = 0;
				$resource->preuInferior = $price['preuInferior'];
			}
		}

		if(isset($_GET["dateStart"])){
			$resource->dataInici = $_GET["dateStart"];
		}

		if(isset($_GET["dateEnd"])){
			$resource->dataFinal = $_GET["dateEnd"];
		}

		$resource->visible = 0;
		$resource->save();

		AgeResource::create(['idEdat'=>$selectAge['rangEdat'], 'idRecurs'=> $insertedId ]);

		if(isset($_GET["tags"])){
			$tags = explode(",", $_GET["tags"]);
			foreach ($tags as $tag) {
			   TagResource::create(['idTag'=>$tag, 'idRecurs'=> $insertedId ]);
			}
		}

		TargetResource::create(['idRecurs' => $insertedId, 'idTarget' => $selectTypeUser['target']]);

		$category_id = $selectCategory['categoria'];

		CategoryResource::create(['idCategoria' => $category_id, 'idRecurs' => $insertedId]);

		if($file = $request->file('image2')){
			$name = time() . $file->getClientOriginalName();
			$string1 = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '', $name);
			$string = preg_replace('/\s*\([^)]*\)/', '', $string1);
			$file->move('img/image',$string);
			$photo = ImageResource::create(['titolImatge'=>'','descImatge'=>'','imatge' => $string ,'ordre'=>1,'idRecurs' => $insertedId]);
		}

		if($file = $request->file('image3')){
			$name = time() . $file->getClientOriginalName();
			$string1 = preg_replace('/[^a-zA-Z0-9_%\[().\]\\/-]/s', '', $name);
			$string = preg_replace('/\s*\([^)]*\)/', '', $string1);
			$file->move('img/image',$string);
			$photo = ImageResource::create(['titolImatge'=>'','descImatge'=>'','imatge' => $string, 'ordre'=>2, 'idRecurs' => $insertedId]);
		}

		return response()->json(['success' => true, 'message' => 'images uploaded']);

	    }
}
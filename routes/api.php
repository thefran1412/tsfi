<?php

use App\Resource;
use App\ImageResource;
use App\TargetResource;
use App\TagResource;
use App\AgeResource;
use App\CategoryResource;
use App\Location;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('categories', 'Categories');
Route::resource('entitats', 'Entitats');
Route::resource('recursos', 'Recursos');

Route::get('recursos/{recurso}', 'Recursos@getResource')->name('recurso.getResource');
Route::get('tags', 'Tags@getTags')->name('tag.getTags');
Route::get('targets', 'Targets@getTargets')->name('target.getTargets');
Route::get('ages', 'EdatsRecomenades@getAge')->name('ages.getAge');
Route::get('typeuser/{typeUser}/{category}', 'Recursos@index')->name('recurso.index');
Route::get('search', 'Recursos@getResultSearch')->name('recurso.getResultSearch');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('submit', function(Request $request){

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
		$file->move('img/image',$name);
		$input['fotoResum'] = $name;
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
		$file->move('img/image',$name);
		$photo = ImageResource::create(['titolImatge'=>'','descImatge'=>'','imatge' => $name ,'ordre'=>1,'idRecurs' => $insertedId]);
	}

	if($file = $request->file('image3')){
		$name = time() . $file->getClientOriginalName();
		$file->move('img/image',$name);
		$photo = ImageResource::create(['titolImatge'=>'','descImatge'=>'','imatge' => $name, 'ordre'=>2, 'idRecurs' => $insertedId]);
	}

	return response()->json(['success' => true, 'message' => 'images uploaded']);

})->name('submit');
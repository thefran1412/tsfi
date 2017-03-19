<?php

use App\Resource;
use App\ImageResource;
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
Route::get('typeuser/{typeUser}/{category}', 'Recursos@index')->name('recurso.index');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('submit', function(Request $request){

	dd($request);


	$input = $request->all();
	
	$input = ['titolRecurs'=>'lala', 'subTitol'=>'po', 'descBreu'=>'lola', 'descDetaill1'=>'asdasd', 'descDetaill2'=>'dasda', 'relevancia'=>20, 'dataInici'=>'2017-02-05 16:23:03', 'dataFinal'=>'2017-02-05 16:23:03', 'gratuit'=>0, 'preuInferior'=>200, 'preuSuperior'=>300, 'dataPublicacio'=>'2017-02-05 16:23:03', 'visible'=>1, 'fotoResum'=>'', 'creatPer'=>'yolo', 'idLocalitzacio'=>2];

	$prueba = Resource::create($input);
	$insertedId = $prueba->recurs_id;

	if($file = $request->file('image')){
		$name = time() . $file->getClientOriginalName();
		$file->move('images',$name);
		$photo = ImageResource::create(['titolImatge'=>'Nombre a cambiar','descImatge'=>'desccripcio','imatge' => $name ,'ordre'=>1,'idRecurs' => $insertedId]);
	}

	if($file = $request->file('image2')){
		$name = time() . $file->getClientOriginalName();
		$file->move('images',$name);
		$photo = ImageResource::create(['titolImatge'=>'Nombre a cambiar','descImatge'=>'desccripcio','imatge' => $name, 'ordre'=>2, 'idRecurs' => $insertedId]);
	}

	return response()->json(['success' => true, 'message' => 'images uploaded']);

})->name('submit');



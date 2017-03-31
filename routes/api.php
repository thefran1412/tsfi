<?php

use App\Resource;
use App\ImageResource;
use App\TargetResource;
use App\CategoryResource;
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
Route::get('search', 'Recursos@getResultSearch')->name('recurso.getResultSearch');


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post('submit', function(Request $request){

	$input = $request->only('titolRecurs','subTitol','descBreu','descDetaill1', 'fotoResum');
	$selectCategory = $request->only('categoria');
	$selectTypeUser = $request->only('target');


	if($file = $request->file('image')){
		$name = time() . $file->getClientOriginalName();
		$file->move('img/image',$name);
		$input['fotoResum'] = $name;
	}

	$prueba = Resource::create($input);
	$insertedId = $prueba->recurs_id;

	$resource = Resource::find($insertedId);
	$resource->visible = 0;
	$resource->save();

	if($selectTypeUser['target'] === 'Estudiants'){
		TargetResource::create(['idRecurs' => $insertedId, 'idTarget' => 2]);
	}

	if($selectTypeUser['target'] === 'Professors'){
		TargetResource::create(['idRecurs' => $insertedId, 'idTarget' => 1]);
	}

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
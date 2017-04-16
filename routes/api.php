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

Route::post('submit', 'SendResource@submit')->name('submit');

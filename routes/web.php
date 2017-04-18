<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('index');
});


Route::get('/tsfi/', function () {
    return view('EventsHome');
});

Auth::routes();

/* BACKEND */
Route::get('/admin', 'backend\Backend@index');
Route::get('/admin/login', 'Auth\LoginController@index');
Route::get('/admin/config', 'backend\Backend@config');
Route::get('/admin/analytics', 'backend\Analytics@index');

//Links data
Route::get('/admin/recursos/categories', 'backend\Recursos@autoCompleteCategory');
Route::get('/admin/recursos/autocomplete', 'publiccontrollers\publicURLs@autocomplete');

/* RECURSOS */
//Route::post('admin/recursos/{id}', array('uses' => 'backend\Recursos@recover'));
//Add resource
Route::get('/admin/recursos/add', 'backend\Recursos@add');
Route::post('/admin/recursos/add', ['as' => 'resource_store','uses' => 'backend\Recursos@store']);

Route::resource('admin/recursos', 'backend\Recursos');
Route::post('admin/recursos/delete/{id}', 'backend\Recursos@destroy');
Route::post('admin/recursos/recover/{id}', 'backend\Recursos@recover');
Route::post('admin/recursos/aprove/{id}', 'backend\Recursos@aprove');

Route::get('/admin/recursos', 'backend\Recursos@index');
//Update resource
Route::get('/admin/recursos/{id}/edit', 'backend\Recursos@edit');
Route::post('/admin/recursos/{id}/edit', ['as' => 'resource_update','uses' => 'backend\Recursos@update']);

/* CATEGORIES */
Route::resource('/admin/categories', 'backend\Categories');
Route::post('/admin/categories/soft/{id}', 'backend\Categories@soft');

/* TAGS */
Route::resource('/admin/tags', 'backend\Tags');
Route::post('/admin/tags/soft/{id}', 'backend\Tags@soft');

/* ENTITATS */
Route::resource('/admin/entitats', 'backend\Entitats');
Route::post('/admin/entitats/soft/{id}', 'backend\Entitats@soft');

/* ENTIDADES */
Route::get('/admin/entitats', 'backend\Entitats@index');
Route::get('/admin/entitats/add', 'backend\Entitats@add');

/* USUARIOS */
Route::get('/admin/usuaris', 'backend\Usuaris@index');
Route::get('/admin/usuaris/add', 'backend\Usuaris@add');
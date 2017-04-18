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

/* RECURSOS */
//Route::resource('admin/recursos', 'backend\Recursos');

Route::get('/admin/recursos', 'backend\Recursos@index');
Route::get('/admin/recursos/add', 'backend\Recursos@add');
Route::post('/admin/recursos/add', ['as' => 'resource_store','uses' => 'backend\Recursos@store']);
Route::get('/admin/recursos/categories', 'backend\Recursos@autoCompleteCategory');
Route::get('/admin/recursos/autocomplete', 'publiccontrollers\publicURLs@autocomplete');
Route::get('/admin/recursos/{id}/edit', 'backend\Recursos@edit');
Route::post('/admin/recursos/{id}/edit', ['as' => 'resource_update','uses' => 'backend\Recursos@update']);
Route::put('/admin/recursos/{recurso}', 'backend\Recursos@update');

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
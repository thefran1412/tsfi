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


// Route::get('/teachers/home/', function () {
//     return view('HomeTeachers');
// });

// Route::get('/login', function () {
//     return view('home');
// });
Auth::routes();

// Route::get('/hola', function () {
//     return 'hola';
// });

/* BACKEND */
Route::get('/admin/login', 'Auth\LoginController@index');
Route::get('/admin', 'backend\Backend@index');
Route::get('/resource', 'backend\Backend@resource');
Route::get('/admin/config', 'backend\Backend@config');
Route::get('/admin/analytics', 'backend\Analytics@index');

/* RECURSOS */
Route::get('/admin/recursos', 'backend\Recursos@index');
Route::get('/admin/recursos/add', 'backend\Recursos@add');
Route::get('/admin/recursos', 'backend\Recursos@index');
Route::get('/admin/recursos/categories', 'backend\Categories@index');
Route::get('/admin/recursos/tags', 'backend\Tags@index');
Route::get('/resource/add', 'backend\Recursos@resource');
Route::post('/resource/add', 'backend\Recursos@storeResource');
Route::get('/resource/list', 'backend\Recursos@listRecurso');

/* ENTIDADES */
Route::get('/admin/entitats', 'backend\Entitats@index');
Route::get('/admin/entitats/add', 'backend\Entitats@add');

/* USUARIOS */
Route::get('/admin/usuaris', 'backend\Usuaris@index');
Route::get('/admin/usuaris/add', 'backend\Usuaris@add');

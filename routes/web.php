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
Route::get('/admin/login', 'Auth\LoginController@index');
Route::get('/admin', 'HomeController@index');
Route::get('/resource', 'HomeController@resource');





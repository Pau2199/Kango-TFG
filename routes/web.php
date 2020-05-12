<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();
//Route::post('/inmuebles/vistaInmueble/anyadirImagenes','inmueblesPublicados@updateImagenes');
Route::get('/inmuebles/vistaInmueble/{id}', 'inmueblesPublicados@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('inmuebles/publicarNuevo', 'publicarNuevoInmuebleController@index');
Route::get('/inmuebles/modificarInmuebleVista/{id}/{pulsado}','inmueblesPublicados@modificarInmuebleVista');
Route::get('/inmuebles/vistaInmueble/borrarImagen/{imagen}','inmueblesPublicados@borrarImagen');
Route::post('/inmuebles/vistaInmueble/modificar/{id}','inmueblesPublicados@update');
Route::post('inmuebles/agregarInmueble', 'publicarNuevoInmuebleController@store');
Route::post('inmuebles/mostrarInmuebles', 'publicarNuevoInmuebleController@store');
Route::get('inmuebles/anunciosActivos', 'publicarNuevoInmuebleController@mostrarInmuebles');

/*Route::get('inmuebles/anunciosActivos', function(){
    return view('index');
});*/

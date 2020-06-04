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

Route::get('/', 'indexController@index');

Auth::routes();

//Gestion de la web

Route::get('/admin/usuarios', 'gestionAdminController@index');
Route::get('/admin/inmuebles', 'gestionAdminController@indexInm');
Route::get('/admin/inmuebles/obtenerDescripcion/{inmueble}', 'gestionAdminController@show');
Route::get('/admin/inmuebles/borrarInm/{inmueble}', 'gestionAdminController@destroy');



Route::get('/inmuebles/vistaInmueble/{id}', 'inmueblesPublicados@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('inmuebles/publicarNuevo', 'publicarNuevoInmuebleController@index');
Route::get('/inmuebles/modificarInmuebleVista/{id}/{pulsado}','inmueblesPublicados@modificarInmuebleVista');
Route::post('/inmuebles/vistaInmueble/borrarImagen','inmueblesPublicados@destroy');
Route::post('/inmuebles/vistaInmueble/modificar/{id}','inmueblesPublicados@update');
Route::post('inmuebles/agregarInmueble', 'publicarNuevoInmuebleController@store');
Route::post('/inmuebles/mostrarInmuebles', 'publicarNuevoInmuebleController@store');
Route::get('/inmuebles/anunciosActivos', 'publicarNuevoInmuebleController@mostrarInmuebles');
Route::post('/inmueble/desactivar', 'inmueblesPublicados@actualizarEstado');
Route::get('/inmueble/cargarProvinciasInm', 'publicarNuevoInmuebleController@cargarProvincias');
Route::get('/inmueble/cargarLocalidadesInm/{selecionada}', 'publicarNuevoInmuebleController@cargarLocalidades');

Route::get('/inmueble/pagar/{id}', 'inmueblesPublicados@pagar')->middleware('Pago');
Route::post('/inmueble/obtenerDatos', 'pagoAlquilerController@show');
Route::post('/inmueble/realizarPago/{id}', 'pagoAlquilerController@store');

Route::get('/perfil/horarioVisita', 'horarioVisitaController@index');
Route::get('/perfil/modificarHorario', 'horarioVisitaController@store');
Route::get('/perfil/obtenerHorarioUsuario', 'horarioVisitaController@obtenerHorario');
Route::get('/perfil/borrarFranjaHoraria/{id}', 'horarioVisitaController@destroy');
Route::post('/obtenerHorarioPropietario', 'horarioVisitaController@obtenerHorarioPropietario');
Route::post('/enviarSolicitudVisita', 'solicitudesController@enviarSolicitudVisita');
Route::get('/perfil/solicitudesVisita', 'solicitudesController@index');
Route::post('/perfil/accionSol', 'solicitudesController@update');
Route::get('/perfil/solicitudesAlquiler', 'pagoAlquilerController@index');
Route::get('/perfil/misalquileres', 'pagoAlquilerController@cargarAlquiler');


Route::get('/perfil/datosPersonales', 'datosPersonalesController@index');
Route::get('/perfil/editarPerfil/{id}', 'datosPersonalesController@editarDatosPersonales');
Route::post('/perfil/modificarDatos', 'datosPersonalesController@update');
Route::get('/perfil/eliminarCuenta/{id}', 'datosPersonalesController@destroy');


Route::get('/obtenerNotificaciones', 'notificacionesController@index');
Route::get('/notificaciones', 'notificacionesController@mostrarVista');
Route::post('/notificaciones/obtenerInformaciónNotificacion', 'solicitudesController@show');
Route::get('/notificaciones/borrarNotificación/{id}', 'notificacionesController@destroy');


Route::post('/favoritos/agregarFavoritos', 'favoritosController@store');
Route::get('/favoritos/mostrarFavoritos', 'favoritosController@index');



//cargar datos de manera dinamica
Route::get('/index/cargarProvincia', 'indexController@cargarProvincias');
//cargar datos localidades de la provincia elegia
Route::get('/index/cargarLocalidades/{provincia}', 'indexController@cargarLocalidades');
Route::get('/index/filtrosBusqueda/{orden}', 'indexController@filtrosBusqueda');


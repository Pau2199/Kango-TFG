<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Address;
use App\Location;
use App\Province;
use App\Favorite;
use Auth;
use DB;

class indexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos = DB::select('SELECT DISTINCT u.nombre, u.primer_apellido, u.segundo_apellido, p.*, a.idLocalidad, a.idProvincia, a.barrio, a.nombre_de_la_direccion, a.tipo_de_via, a.codigo_postal FROM users u, property p, address a WHERE p.idUsuario = u.id && p.id = a.idInmueble && p.disponible = 1');

        for($i = 0 ; $i<count($datos); $i++){
            $alquiler = DB::select('SELECT r.internet, r.animales, r.reformas, r.calefaccion, r.aireAcondicionado, r.fianza FROM rental r WHERE r.idInmueble = "'. $datos[$i]->id.'"');
            $datos[$i]->datosAlq = $alquiler;
            if(count($alquiler) > 0){
                $datos[$i]->alquiler = true;
            }else{
                $datos[$i]->alquiler = false;
            }

            $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'" && i.nombre LIKE "perfil%"');
            $datos[$i]->img = $imagenes;

            $datos[$i]->idLocalidad = DB::select('SELECT l.nombre FROM localities l WHERE id = '. $datos[$i]->idLocalidad);
            $datos[$i]->idProvincia = DB::select('SELECT p.nombre FROM provinces p WHERE id = '. $datos[$i]->idProvincia);

            if(Auth::check()){
                $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $datos[$i]->id)->get();
                if(count($favorito) > 0){
                    $datos[$i]->favorito = true;
                }else{
                    $datos[$i]->favorito = false;
                }
            }else{
                if(isset($_COOKIE['favoritos'])){
                    $array = explode(',', $_COOKIE['favoritos']);
                    for($j = 0; $j<count($array); $j++ ){
                        $id = explode('-', $array[$j]);
                        if($id[1] == $datos[$i]->id){
                            $datos[$i]->favorito = true;
                            break;
                        }else{
                            $datos[$i]->favorito = false;
                        }
                    }
                }else{
                    $datos[$i]->favorito = false;
                }
            }

        }

        return view('index')->with('datos', $datos);
    }   

    public function cargarProvincias(){

        $provincias = Address::select('idProvincia')->distinct()->get();
        for($i = 0 ; $i<count($provincias) ; $i++){
            $provincias[$i]->idProvincia  = Province::select('nombre')->where('id', '=', $provincias[$i]->idProvincia)->get();
        }
        return $provincias;

    }

    public function cargarLocalidades($provincia){
        $id = Province::select('id')->where('nombre', $provincia)->get();
        $localidades = Location::select('nombre')->where('idProvincia', $id[0]->id)->get();
        return $localidades;
    }

    public function filtrosBusqueda(Request $request, $orden){
        $es_alquiler = false;
        $es_compra = false;
        $where = "";
        $whereAlquiler = "";
        $consultaVenta = 'SELECT DISTINCT u.nombre, u.primer_apellido, u.segundo_apellido, p.*, a.idProvincia, a.idLocalidad, a.barrio, a.nombre_de_la_direccion, a.tipo_de_via, a.codigo_postal FROM users u, property p, sale s, address a WHERE p.idUsuario = u.id && p.id = a.idInmueble && p.disponible = 1 && p.id = s.idInmueble ';
        $consultaAlquiler = 'SELECT DISTINCT u.nombre, u.primer_apellido, u.segundo_apellido, p.*, a.idProvincia, a.idLocalidad, a.barrio, a.nombre_de_la_direccion, a.tipo_de_via, a.codigo_postal, r.internet, r.animales, r.reformas, r.calefaccion, r.aireAcondicionado, r.fianza FROM users u, property p, rental r, address a WHERE p.idUsuario = u.id && p.id = a.idInmueble && p.disponible = 1 && p.id = r.idInmueble ';
        $consultaTotal = 'SELECT DISTINCT u.nombre as userNombre, u.primer_apellido, u.segundo_apellido, p.*, a.idProvincia, a.idLocalidad, a.barrio, a.nombre_de_la_direccion, a.tipo_de_via, a.codigo_postal FROM users u, property p, address a WHERE p.idUsuario = u.id && p.id = a.idInmueble && p.disponible = 1 ';

        $datos;

        if($request->tipoBusqueda != null){
            if($request->tipoBusqueda == 'alquiler'){
                $es_alquiler = true;
            }else{
                $es_compra = true;
            }
        }

        if($request->provincia != null && $request->provincia != '-'){
            $id = Province::select('id')->where('nombre', $request->provincia)->get();
            $where = '&& a.idProvincia = "'.$id[0]->id.'" ';
        }
        if($request->localidad != null && $request->localidad != '-'){
            $id = Location::select('id')->where('nombre', $request->localidad)->get();
            $where .= '&& a.idLocalidad = "'.$id[0]->id.'" ';
        }

        if($request->tipoInmueble != null && $request->tipoInmueble != '-'){
            $where .= '&& p.tipo_de_vivienda = "'.$request->tipoInmueble.'" ';
        }

        if($request->nHabitaciones != null){
            $where .= '&& p.n_habitaciones = '.intval($request->nHabitaciones). ' '; 
        }

        if($request->nBanyos != null){
            $where .= '&& p.n_cuartos_de_banyo = '.(intval($request->nBanyos). ' ');
        }

        if($request->garage != null){
            $where .= '&& p.garage = true ';
        }

        if($request->piscina != null){
            $where .= '&& p.piscina = true ';
        }
        if($request->ascensor != null){
            $where .= '&& p.ascensor = true ';
        }

        if($es_alquiler == true){
            if($request->internet != null){
                $whereAlquiler .= '&& internet = true ';
            }
            if($request->calefaccion != null){
                $whereAlquiler .= '&& calefaccion = true ';
            }
            if($request->aireAcondicionado != null){
                $whereAlquiler .= '&& aireAcondicionado = true ';
            }
            if($request->animales != null){
                $whereAlquiler .= '&& animales = true ';
            }
            if($request->reformas != null){
                $whereAlquiler .= '&& reformas = true ';
            }
        }

        if($es_compra == true){
            if($where != ""){
                $consultaVenta .= $where;
            }
            if($orden != 'nada'){
                $consultaVenta .= 'ORDER BY p.precio '.$orden; 
            }
            $datos = DB::select($consultaVenta);
        }else if($es_alquiler == true){
            if($where != ""){
                $consultaAlquiler .= $where;
            }
            if($whereAlquiler != ""){
                $consultaAlquiler .= $whereAlquiler;
            }
            if($orden != 'nada'){
                $consultaAlquiler .= 'ORDER BY p.precio '.$orden; 
            }
            $datos = DB::select($consultaAlquiler);
            for($i = 0; $i<count($datos); $i++){
                $datos[$i]->alquiler = true;
            }
        }else{
            if($where != ""){
                $consultaTotal .= $where;
            }
            if($orden != 'nada'){
                $consultaTotal .= 'ORDER BY p.precio '.$orden; 
            }

            $datos = DB::select($consultaTotal);
            for($i = 0; $i<count($datos); $i++){
                $alquiler = DB::select('SELECT r.internet, r.animales, r.reformas, r.calefaccion, r.aireAcondicionado, r.fianza FROM rental r WHERE r.idInmueble = '. $datos[$i]->id);

                $datos[$i]->datosAlq = $alquiler;
                if(count($alquiler)>0){
                    $datos[$i]->alquiler = true;
                }else{
                    $datos[$i]->alquiler = false;
                }
            }
        }

        for($i = 0; $i<count($datos); $i++){
            $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'" && i.nombre LIKE "perfil%"');
            $datos[$i]->img = $imagenes;
            $datos[$i]->idProvincia = Province::select('nombre')->where('id', $datos[$i]->idProvincia)->get();
            $datos[$i]->idLocalidad = Location::select('nombre')->where('id', $datos[$i]->idLocalidad)->get();
            if(Auth::check()){
                $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $datos[$i]->id)->get();
                if(count($favorito) > 0){
                    $datos[$i]->favorito = true;
                }else{
                    $datos[$i]->favorito = false;
                }
            }else{
                if(isset($_COOKIE['favoritos'])){
                    $array = explode(',', $_COOKIE['favoritos']);
                    for($j = 0; $j<count($array); $j++ ){
                        $id = explode('-', $array[$j]);
                        if($id[1] == $datos[$i]->id){
                            $datos[$i]->favorito = true;
                            break;
                        }else{
                            $datos[$i]->favorito = false;
                        }
                    }
                }else{
                    $datos[$i]->favorito = false;
                }
            }
        }

        return $datos;
    }
}

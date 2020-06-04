<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Property;
use App\Address;
use App\Rental;
use App\Location;
use App\Province;
use Auth;

class favoritosController extends Controller
{

    public function index()
    {
        $dato = [];
        if(Auth::check()){
            $favorito = Favorite::where('idUser', '=', Auth::User()->id)->get();
            if(count($favorito) > 0){
                for($i  = 0 ; $i<count($favorito); $i++){
                    $dato[$i] = Property::select('id','precio','tipo_de_vivienda','disponible')->where('id', $favorito[$i]->idInmueble)->first();
                    $direccion = Address::select('id','idLocalidad', 'idProvincia', 'nombre_de_la_direccion','tipo_de_via')->where('idInmueble', '=',$dato[$i]->id)->get();
                    $direccion[0]->idLocalidad = Location::select('nombre')->where('id', $direccion[0]->idLocalidad)->get();
                    $direccion[0]->idProvincia = Province::select('nombre')->where('id', $direccion[0]->idProvincia)->get();
                    $dato[$i]->direccion = $direccion;
                    $alquiler = Rental::select('fianza', 'id')->where('idInmueble', '=', $dato[$i]->id)->get();
                    if(count($alquiler) > 0){
                        $dato[$i]->alquiler = 1;
                        $dato[$i]->datosAlq = $alquiler;
                    }else{
                        $dato[$i]->alquiler = 0;

                    }
                }
            }
        }else{
            if(isset($_COOKIE['favoritos'])){
                $array = explode(',', $_COOKIE['favoritos']);
                for($j = 0; $j<count($array); $j++ ){
                    $id = explode('-', $array[$j]);
                    $dato[$j] = Property::select('id','precio','tipo_de_vivienda','disponible')->where('id', $id[1])->first();
                    $direccion = Address::select('id','idLocalidad', 'idProvincia', 'nombre_de_la_direccion','tipo_de_via')->where('idInmueble', '=',$id[1])->get();
                    $direccion[0]->idLocalidad = Location::select('nombre')->where('id', $direccion[0]->idLocalidad)->get();
                    $direccion[0]->idProvincia = Province::select('nombre')->where('id', $direccion[0]->idProvincia)->get();
                    $dato[$j]->direccion = $direccion;
                    $alquiler = Rental::select('fianza', 'id')->where('idInmueble', '=', $id[1])->get();
                    if(count($alquiler) > 0){
                        $dato[$j]->alquiler = 1;
                        $dato[$j]->datosAlq = $alquiler;
                    }else{
                        $dato[$j]->alquiler = 0;
                    }
                }
            }
        }

        return view('favoritos')->with('datos', $dato);
    }

    public function store(Request $request)
    {
        $id = explode('-', $request->idInmueble);
        $error = false;
        if($request->eliminarFav == 0){
            $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $id[1])->get();
            $error = false;
            if (count($favorito) == 0){
                $fav = new Favorite;
                $fav->idUser = Auth::User()->id;
                $fav->idInmueble = $id[1];
                $fav->save();   
            }else{
                $error = true;
            }
        }else{
            Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $id[1])->delete();
        }
        return $request->eliminarFav;
    }
}

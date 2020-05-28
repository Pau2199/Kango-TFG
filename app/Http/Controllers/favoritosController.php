<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Property;
use App\Address;
use App\Rental;
use Auth;

class favoritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dato = [];
        if(Auth::check()){
            $favorito = Favorite::where('idUser', '=', Auth::User()->id)->get();
            if(count($favorito) > 0){
                for($i  = 0 ; $i<count($favorito); $i++){
                    $dato[$i] = Property::select('id','precio','tipo_de_vivienda','disponible')->where('id', $favorito[$i]->idInmueble)->first();
                    $direccion = Address::select('id','localidad', 'provincia', 'nombre_de_la_direccion','tipo_de_via')->where('idInmueble', '=',$dato[$i]->id)->get();
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
                    $direccion = Address::select('id','localidad', 'provincia', 'nombre_de_la_direccion','tipo_de_via')->where('idInmueble', '=',$id[1])->get();
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

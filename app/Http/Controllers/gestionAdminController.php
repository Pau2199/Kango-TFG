<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Property;
use App\Rental;
use App\Address;
use App\Province;
use App\Location;
use App\Image;
use App\Is_Rented;
use DB;

class gestionAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gestionUser')->with('users', User::all());
    }

    public function indexInm(){
        $inmueble = Property::all();

        for($i = 0 ; $i < count($inmueble) ; $i++){
            $alquiler = Rental::where('idInmueble', '=', $inmueble[$i]->id)->get();
            if(count($alquiler) > 0){
                $inmueble[$i]->alquiler = true;    
            }else{
                $inmueble[$i]->alquiler = false;
            }
            $usuario = User::select('nombre', 'primer_apellido', 'segundo_apellido')->where('id', '=', $inmueble[$i]->idUsuario)->get();
            $inmueble[$i]->usuario = $usuario;
            $direccion = Address::where('idInmueble', '=', $inmueble[$i]->id)->get();
            $inmueble[$i]->direccion = $direccion;
            $inmueble[$i]->direccion[0]->idProvincia = Province::select('nombre')->where('id', $inmueble[$i]->direccion[0]->idProvincia)->get();
            $inmueble[$i]->direccion[0]->idLocalidad = Location::select('nombre')->where('id', $inmueble[$i]->direccion[0]->idLocalidad)->get();
        }

        return view('gestionInm')->with('inmueble', $inmueble);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = explode('-', $id);
        $descripcion = Property::select('descripcion')->where('id', '=', $id[1])->get();

        return $descripcion;
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
        $error = false;
        $id = explode('-', $id);
        $alquiler = Rental::where('idInmueble', '=', $id[1])->get();
        if(count($alquiler) > 0){
            $isrented = Is_Rented::where('idAlquiler', '=', $alquiler[0]->id)->get();
            if(count($isrented) > 0){
                if($isrented->estado != 'Aceptada' && $isrented->estado == 'Enviada'){
                    $isrented->delete();
                }else{
                    $error = true;
                }   
            }
            DB::table('rental')->where('idInmueble', '=', $id[1])->delete();
        }

        if($error == false){
            $direccion = Address::where('idInmueble', '=', $id[1])->first();
            $direccion->delete();
            $image = Image::where('idInmueble', '=', $id[1])->get();
            for($i = 0 ; $i<count($image); $i++){
                unlink('uploads/'.$image[$i]->nombre);
                $image[$i]->delete();
            }
            Property::find($id[1])->delete();
        }

        return $error;
    }
}

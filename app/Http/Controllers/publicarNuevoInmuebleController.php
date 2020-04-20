<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;
use App\Image;
use App\Address;


class publicarNuevoInmuebleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('formInmuebleNuevo');
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
        $inmueble = new Property;
        $inmueble->idUsuario = $request->usuario;
        $inmueble->metros_cuadrados = $request->nMetrosCuadrados;
        $inmueble->precio = $request->precio;
        $inmueble->tipo_de_vivienda = $request->tipoInmueble;
        $inmueble->descripcion = $request->descripcion;
        $inmueble->n_habitaciones = $request->nHabitaciones;
        $inmueble->n_cuartos_de_banyo = $request->nCuartosBanyo;
        //$inmueble->tipo_publicacion = $request->tipoCompra;

        /*INICIO COMPROBAR EXTRAS*/
        //comprobar Ascensor
        if($request->ascensor != null){
            $inmueble->ascensor = true;
        }else{
            $inmueble->ascensor = false;
        }

        //comrpobar Garage
        if($request->garage != null){
            $inmueble->garage = true;
        }else{
            $inmueble->garage = false;
        }

        //comprobar Piscina
        if($request->piscina != null){
            $inmueble->piscina = true;
        }else{
            $inmueble->piscina = false;
        }
        /*FIN COMPROBAR EXTRAS*/


        //Si el inmueble se alquila
        if($request->tipoCompra == 'A' || $request->tipoCompra == 'AQ'){
            $inmueble->fianza = $request->fianza;

            /*INICIO COMPROBAR EXTRAS ALQUILER*/

            //comprobar animales
            if($request->animales != null){
                $inmueble->animales = true;
            }else{
                $inmueble->animales = false;
            }

            //comprobar reformas
            if($request->reformas != null){
                $inmueble->reformas = true;
            }else{
                $inmueble->reformas = false;
            }

            //comprobar internet
            if($request->internet != null){
                $inmueble->internet = true;
            }else{
                $inmueble->internet = false;
            }

            //comprobar calefaccion
            if($request->calefaccion != null){
                $inmueble->calefaccion = true;
            }else{
                $inmueble->calefaccion = false;
            }

            //comprobar aire acondicionado
            if($request->aire != null){
                $inmueble->aireAcondicionado = true;
            }else{
                $inmueble->aireAcondicionado = false;
            }
            /*FIN COMPROBAR EXTRAS ALQUILER*/
        }

        $inmueble->save();

        //Agregamos ahora la direccion del inmueble;

        $direccion = new Address;
        $direccion->tipo_de_via = $request->tipoVia;
        $direccion->localidad = $request->localidad;
        $direccion->provincia = $request->provincia;
        $direccion->nombre_de_la_direccion = $request->nombreDir;
        $direccion->codigo_postal = 46017; //$request->cp;
        $direccion->nPuerta = $request->nPuerta;
        $direccion->nPatio = $request->nPatio;
        $direccion->nPiso = $request->nPiso;

        //Comprobar si hay escalera
        if($request->escalera != null){
            $direccion->escalera = $request->escalera;
        }

        //comprobar si hay bloque
        if($request->bloque != null){
            $direccion->bloque = $request->bloque;
        }

        $direccion->idInmueble = $inmueble->id;
        $direccion->save();

        //Agregamos a la base de datos las imagenes y las guardamos en una carpeta

        $imagen = $request->file('perfil');
        $imagen->move('uploads', 'perfil'.$inmueble->id.'.'.$imagen->getClientOriginalExtension());

        $img = new Image;
        $img->nombre = 'perfil'.$inmueble->id.'.'.$imagen->getClientOriginalExtension();
        $img->idInmueble = $inmueble->id;

        $img->save();

        if($request->masImagenes != null){
            $imagen = $request->file('masImagenes');
            foreach($imagen as $key => $valor){
                if($key == 0){
                    $aux = new Image;
                    $valor->move('uploads', $img->id.'.'.$valor->getClientOriginalExtension());
                    $aux->nombre = $img->id.'.'.$valor->getClientOriginalExtension();
                    $aux->idInmueble = $inmueble->id;
                    $aux->save();
                }else{
                    $aux2 = new Image;
                    $valor->move('uploads', $aux->id.'.'.$valor->getClientOriginalExtension());
                    $aux2->nombre = $aux->id.'.'.$valor->getClientOriginalExtension();
                    $aux2->idInmueble = $inmueble->id;
                    $aux2->save();
                }
            }
        }





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

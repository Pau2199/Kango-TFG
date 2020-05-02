<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Property;
use App\Image;
use App\Address;
use App\Rental;
use App\Sale;
use Auth;
use App\User;
use DB;

class inmueblesPublicados extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $id = explode('-', $id);
        $datos;

        if($id[0] == 'A'){            $datos=User::select('property.*','address.tipo_de_via','address.barrio','address.localidad','address.provincia','address.nombre_de_la_direccion','address.codigo_postal','address.nPatio','rental.internet', 'rental.animales', 'rental.reformas', 'rental.calefaccion', 'rental.aireAcondicionado', 'rental.fianza')
                ->join('property', 'users.id', '=', 'property.idUsuario')
                ->join('address', 'property.id', '=', 'address.idInmueble')
                ->join('rental', 'property.id', '=', 'rental.idInmueble')
                ->where('property.idUsuario', Auth::user()->id)
                ->where('property.id', $id[1])
                ->get();

            for($i = 0 ; $i<count($datos) ; $i++){
                $imagenes = DB::select('SELECT i.nombre FROM image i WHERE idInmueble = "'. $datos[$i]->id .'"');
                $datos[$i]->img = $imagenes;
                $datos[$i]->alquiler = true;
            }
        }



        return view('vistaInmueble')->with('datos', $datos);
    }
    
    public function modificarInmuebleVista($id, $pulsado){
        $prueba = 'preuab de erorororororororo';
        return view('formInmuebleNuevo')
            ->with('id', $id)
            ->with('pulsado', $pulsado)
            ->with('prueba', $prueba);
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
        return $id;
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

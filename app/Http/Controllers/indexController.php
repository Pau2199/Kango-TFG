<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $datos = DB::select('SELECT DISTINCT u.nombre, u.primer_apellido, u.segundo_apellido, p.*, a.localidad, a.provincia, a.barrio, a.nombre_de_la_direccion, a.tipo_de_via, a.codigo_postal FROM users u, property p, rental r, sale s, address a WHERE p.idUsuario = u.id && p.id = a.idInmueble && p.disponible = 1');

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
        }

        return view('index')->with('datos', $datos);

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

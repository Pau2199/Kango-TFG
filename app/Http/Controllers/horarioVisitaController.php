<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visiting_hour;
use Auth;


class horarioVisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('horarioVisita');
    }

    public function obtenerHorario(){
        $dias = array('Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo');
        $datos = [];

        for ($i = 0 ; $i<count($dias) ; $i++){
            $horas = Visiting_hour::where('dia', '=', $dias[$i])->get();
            $datos[$dias[$i]] = $horas; 
        }

        return $datos;
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
        $agregados = Visiting_hour::where('dia', '=', $request->dia)->get();
        $existe = false;
        if(count($agregados) != 0){
            for($i = 0 ; $i<count($agregados); $i++){
                if($request->horaInicio == $agregados[$i]->hora_inicio){
                    $existe = true;
                    break;
                }
            }
        }
        if($existe == false){
            $vnueva = new Visiting_hour;
            $vnueva->hora_inicio = $request->horaInicio;
            $vnueva->hora_final = $request->horaFinal;
            $vnueva->dia = $request->dia;
            $vnueva->idUsuario = Auth::user()->id;
            $vnueva->save();
        }
        return array('error' => $existe, 'id'=>$vnueva->id);
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
        $agregados = Visiting_hour::where('id', '=', $id);
        $agregados->delete();
    }
}

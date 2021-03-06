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

    public function obtenerHorarioPropietario(Request $request){
        $agregados = Visiting_hour::where('dia', '=', $request->nombreDia)->where('idUsuario', '=', $request->idUser)->get();
        return $agregados;
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
    
    public function enviarSolicitudVisita(Request $request){
        return $request;
    }

    public function store(Request $request)
    {
        $agregados = Visiting_hour::where('dia', '=', $request->dia)->where('idUsuario', '=', Auth::user()->id)->get();
        $existe = false;
        $vnueva = "";
        if(count($agregados) > 0){
            for($i = 0 ; $i<count($agregados); $i++){
                if($request->horaInicio == $agregados[$i]->hora_inicio){
                    $existe = true;
                    break;
                }
            }
        }
        if($existe == false){;
            $vnueva = new Visiting_hour;
            $vnueva->inicio = $request->horaInicio;
            $vnueva->final = $request->horaFinal;
            $vnueva->dia = $request->dia;
            $vnueva->idUsuario = Auth::user()->id;
            $vnueva->save();
        }
        if($existe == true){
            return array('error' => $existe);
        }else{
            return array('error' => $existe, 'id' => $vnueva->id);
        }
    }

    public function destroy($id)
    {
        $agregados = Visiting_hour::where('id', '=', $id);
        $agregados->delete();
    }
}

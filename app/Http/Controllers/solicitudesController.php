<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitude;
use App\Notification;

class solicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function enviarSolicitudVisita(Request $request){
        $error = false;
        $mensaje = '';

        $solicitudes = Solicitude::where('idInmueble', '=', $request->inmueble)->where('solicitadaAIdUser', '=', $request->propietario)->where('solicitadaDeIdUser', '=', $request->usuarioSolicitante)->get();

        if(count($solicitudes) == 0){
            $solicitudes = Solicitude::where('solicitadaDeIdUser', '=', $request->usuarioSolicitante)->where('estado', '=', 'enviada')->get();

            if(count($solicitudes)<=2){
                $solicitudes = Solicitude::where('solicitadaDeIdUser', '=', $request->usuarioSolicitante)->where('fecha_solicitada', '=', $request->fecha)->where('hora', '=', $request->hora)->get();

                if(count($solicitudes) == 0){

                    $sol = new Solicitude;
                    $sol->idInmueble = $request->inmueble;
                    $sol->solicitadaAIdUser = $request->propietario;
                    $sol->solicitadaDeIdUser = $request->usuarioSolicitante;
                    $sol->estado = 'enviada';
                    $sol->fecha_solicitada = $request->fecha;
                    $sol->hora = $request->hora;
                    $sol->save();
                    
                    $fecha = getdate();
                    $notification = new Notification;
                    
                    $notification->fecha = $fecha['year'] . '/' . $fecha['mon'] . '/' . $fecha['mday'];
                    $notification->titulo = "Solicitud de Visita";
                    $notification->leido = false;
                    $notification->idUsuario = $request->propietario;
                    $notification->idRequest = $sol->id;
                    $notification->save();
                    
                }else{
                    $error = true;
                    $mensaje = 'Ya tienes una solicitud enviada a un inmueble para esa misma fecha y hora';
                }

            }else{
                $error = true;
                $mensaje = 'Ya tienes tres solicitudes enviadas, no puedes solicitar más en estos momentos.';
            }
        }else{
            $error = true;
            $mensaje = 'Esta solicitud ya ha sido enviada';
        }
        return json_encode(array('error' => $error, 'mensaje' => $mensaje));
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

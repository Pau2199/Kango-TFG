<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitude;
use App\Notification;
use App\User;
use App\Address;
use Auth;

class solicitudesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $solicitud = Solicitude::where('solicitadaAIdUser', '=', Auth::user()->id)->get();
        for($i = 0 ; $i<count($solicitud) ; $i++){
            $direccion = Address::select('id','localidad', 'provincia', 'nombre_de_la_direccion','tipo_de_via')->where('id', '=',$solicitud[$i]->idInmueble)->get();
            $solicitud[$i]->direccion = $direccion;
            $datosSolicitante = User::select('id','nombre', 'primer_apellido', 'segundo_apellido')->where('id', '=',$solicitud[$i]->solicitadaDeIdUser)->get();
            $solicitud[$i]->datosSolicitante = $datosSolicitante;
        }
        return view('solicitudesVisita')->with('soli', $solicitud);
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
    public function show(Request $request)
    {
        $notificacion = Notification::find($request->idNoti);
        $notificacion->leido = true;
        $notificacion->save();
        $user;
        $tipoNotificacion = explode('-', $notificacion->titulo);
        $solicitudes = Solicitude::select('fecha_solicitada', 'hora', 'solicitadaDeIdUser','solicitadaAIdUser', 'idInmueble')->find($notificacion->idRequest);

        if($tipoNotificacion[1] == 'Recibida'){
            $user = User::select('nombre', 'primer_apellido', 'segundo_apellido')->find($solicitudes->solicitadaDeIdUser);
        }else{
            $user = User::select('nombre', 'primer_apellido', 'segundo_apellido')->find($solicitudes->solicitadaAIdUser);
        }
        $address = Address::select('tipo_de_via', 'localidad', 'provincia', 'nombre_de_la_direccion','nPatio')->find($solicitudes->idInmueble);

        return json_encode(array('tipoNoti' => $tipoNotificacion[1],'infoSolicitud' => $solicitudes, 'infoUser' => $user, 'direccionInmuebleSolicitado' => $address, 'nombreUserLogin' => Auth::user()->nombre));

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
    public function update(Request $request)
    {
        $idSolicitud = explode('-', $request->idSolicitud);
        $idUsuarioSolicitante = explode('-', $request->idUsuarioSolicitante);
        $solicitud = Solicitude::find($idSolicitud[1]);

        $fecha = getdate();
        $notificacion = new Notification();
        $notificacion->fecha = $fecha['year'] . '/' . $fecha['mon'] . '/' . $fecha['mday'];
        $notificacion->leido = false;
        $notificacion->idUsuario = $idUsuarioSolicitante[1];
        $notificacion->idRequest = $idSolicitud[1];


        if($request->accion == 'success'){
            $solicitud->estado = "Aceptada";
            $solicitud->save();
            $notificacion->titulo = 'Solicitud de Visita - Aceptada';
            $notificacion->save();
        }else if($request->accion == 'danger'){
            $solicitud->estado = "Rechazada";
            $solicitud->save();
            $notificacion->titulo = 'Solicitud de Visita - Rechazada';
            $notificacion->save();
        }

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitude;
use App\Notification;
use App\User;
use App\Address;
use App\Location;
use App\Province;
use App\Is_Rented;
use App\Property;
use App\Rental;
use DB;
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

        $solicitud = Solicitude::where('solicitadaAIdUser', '=', Auth::user()->id)->where('hora','<>', 'no aplica')->get();
        for($i = 0 ; $i<count($solicitud) ; $i++){
            $direccion = Address::select('id','idLocalidad', 'idProvincia', 'nombre_de_la_direccion','tipo_de_via')->where('id', '=',$solicitud[$i]->idInmueble)->get();
            $direccion->idLocalidad = Location::select('nombre')->where('id', $direccion[0]->idLocalidad)->get();
            $direccion->idProvincia = Province::select('nombre')->where('id',$direccion[0]->idProvincia)->get();
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
                    $sol->estado = 'Enviada';
                    $sol->fecha_solicitada = $request->fecha;
                    $sol->hora = $request->hora;
                    $sol->save();

                    $fecha = getdate();
                    $notification = new Notification;

                    $notification->fecha = $fecha['year'] . '/' . $fecha['mon'] . '/' . $fecha['mday'];
                    $notification->titulo = "Solicitud de Visita - Recibida";
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
            $mensaje = 'Ya has enviado una solicitud de visita para este propietario';
        }
        return json_encode(array('error' => $error, 'mensaje' => $mensaje));
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
        $fianza;
        $precio;
        $alquiler;
        $tipoNotificacion = explode('-', $notificacion->titulo);
        $solicitudes = Solicitude::select('fecha_solicitada', 'hora', 'solicitadaDeIdUser','solicitadaAIdUser', 'idInmueble')->find($notificacion->idRequest);
        if(count($tipoNotificacion) > 1){
            if(trim($tipoNotificacion[1]) == 'Recibida'){
                $user = User::select('nombre', 'primer_apellido', 'segundo_apellido')->find($solicitudes->solicitadaDeIdUser);
            }else{
                $user = User::select('nombre', 'primer_apellido', 'segundo_apellido')->find($solicitudes->solicitadaAIdUser);
            }
        }else{
            $tipoNotificacion = explode(' ', $tipoNotificacion[0]);
            if(trim($tipoNotificacion[0]) == 'Petición'){
                $tipoNotificacion = 'Petición';
                $user = User::select('nombre', 'primer_apellido', 'segundo_apellido')->find($solicitudes->solicitadaDeIdUser);
                $alquiler = Is_rented::select('fecha_final', 'fecha_inicio')->where('idUsuario', '=', $solicitudes->solicitadaDeIdUser)->get();
                $fianza = Rental::select('fianza')->where('idInmueble', '=', $solicitudes->idInmueble)->get();
                $precio = Property::select('precio')->find($solicitudes->idInmueble);   
            }else if(trim($tipoNotificacion[0]) == 'Admitida'){
                $tipoNotificacion = 'Admitida';
                $user = User::select('nombre', 'primer_apellido', 'segundo_apellido', 'email')->find($solicitudes->solicitadaAIdUser);
                $alquiler = Is_rented::select('fecha_final', 'fecha_inicio', 'numero_de_cuenta')->where('idUsuario', '=', $solicitudes->solicitadaDeIdUser)->get();
                $fianza = Rental::select('fianza')->where('idInmueble', '=', $solicitudes->idInmueble)->get();
                $precio = Property::select('precio')->find($solicitudes->idInmueble);   
            }else{
                $tipoNotificacion = 'Rechazada';
                $user = User::select('nombre', 'primer_apellido', 'segundo_apellido')->find($solicitudes->solicitadaAIdUser);
            }
        }

        $address = Address::select('tipo_de_via', 'idLocalidad', 'idProvincia', 'nombre_de_la_direccion','nPatio')->find($solicitudes->idInmueble);
        $address->idLocalidad = Location::select('nombre')->where('id', $address->idLocalidad)->get();
        $address->idProvincia = Province::select('nombre')->where('id', $address->idProvincia)->get();

        if($tipoNotificacion == 'Petición' || $tipoNotificacion == 'Admitida'){
            return json_encode(array('idNotificacion' => $request->idNoti, 'tipoNoti' => $tipoNotificacion,'infoSolicitud' => $solicitudes, 'infoUser' => $user, 'direccionInmuebleSolicitado' => $address, 'nombreUserLogin' => Auth::user()->nombre, 'datosAlquiler' => $alquiler, 'precio' => $precio, 'fianza' => $fianza));
        }else if($tipoNotificacion == 'Rechazada'){
            return json_encode(array('idNotificacion' => $request->idNoti, 'tipoNoti' => $tipoNotificacion,'infoSolicitud' => $solicitudes, 'infoUser' => $user, 'direccionInmuebleSolicitado' => $address, 'nombreUserLogin' => Auth::user()->nombre));
        }else{
            return json_encode(array('idNotificacion' => $request->idNoti, 'tipoNoti' => $tipoNotificacion[1],'infoSolicitud' => $solicitudes, 'infoUser' => $user, 'direccionInmuebleSolicitado' => $address, 'nombreUserLogin' => Auth::user()->nombre));
        }

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
        $rented ="";
        $fecha = getdate();
        $notificacion = new Notification();
        $notificacion->fecha = $fecha['year'] . '/' . $fecha['mon'] . '/' . $fecha['mday'];
        $notificacion->leido = false;
        $notificacion->idUsuario = $idUsuarioSolicitante[1];
        $notificacion->idRequest = $idSolicitud[1];


        if($request->accion == 'success'){
            $solicitud->estado = "Aceptada";
            $solicitud->save();

            if($idSolicitud[0] == 'SV'){
                $notificacion->titulo = 'Solicitud de Visita - Aceptada';
            }else{
                $rented = Is_Rented::where('idUsuario', '=', $idUsuarioSolicitante[1])->get();
                DB::update('UPDATE is_rented SET estado = "Aceptada" WHERE idAlquiler = ' .$rented[0]->idAlquiler . ' AND idUsuario = ' . $rented[0]->idUsuario);
                $notificacion->titulo = 'Admitida la Petición de Alquiler';
            }
            $notificacion->save();
        }else if($request->accion == 'danger'){
            $solicitud->estado = "Declinado";
            $solicitud->save();
            if($idSolicitud[0] == 'SV'){
                $notificacion->titulo = 'Solicitud de Visita - Declinado';
            }else{
                $rented = Is_Rented::where('idUsuario', '=', $idUsuarioSolicitante[1])->get();
                DB::table('is_rented')->where('idUsuario',$idUsuarioSolicitante[1])->delete();
                $notificacion->titulo = 'Rechazada la petición de Alquiler';
            }
            $notificacion->save();
        }

        return $rented;

    }
}

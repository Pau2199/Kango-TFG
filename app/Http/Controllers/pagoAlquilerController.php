<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Rental;
use App\Is_Rented;
use App\Notification;
use App\Solicitude;
use App\Address;
use App\User;
use App\Location;
use App\Province;
use DB;
use Auth;

class pagoAlquilerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $solicitud = Solicitude::where('hora', '=', 'no aplica')->where('solicitadaAIdUser', '=', Auth::user()->id)->get();
        for($i = 0 ; $i<count($solicitud) ; $i++){
            $direccion = Address::select('id','idLocalidad', 'idProvincia', 'nombre_de_la_direccion','tipo_de_via')->where('id', '=',$solicitud[$i]->idInmueble)->get();
            $direccion->idLocalidad = Location::select('nombre')->where('id', $direccion[0]->idLocalidad)->get();
            $direccion->idProvincia = Province::select('nombre')->where('id',$direccion[0]->idProvincia)->get();
            $solicitud[$i]->direccion = $direccion;
            $datosSolicitante = User::select('id','nombre', 'primer_apellido', 'segundo_apellido')->where('id', '=',$solicitud[$i]->solicitadaDeIdUser)->get();
            $solicitud[$i]->datosSolicitante = $datosSolicitante;
            $datosAlquiler = DB::select('SELECT fecha_inicio, fecha_final, estado FROM is_rented i, rental r, property p WHERE i.idAlquiler = r.id AND r.idInmueble = p.id AND p.idUsuario = ' .$solicitud[$i]->solicitadaAIdUser);
            $solicitud[$i]->datosAlquiler = $datosAlquiler;

        }
        return view('solicitudesAlquiler')->with('soli', $solicitud);
    }

    public function cargarAlquiler(){
        $alquiler = Is_Rented::where('idUsuario', '=', Auth::user()->id)->get();
        for($i = 0 ; $i<count($alquiler) ; $i++){

            $fianza = Rental::select('idInmueble', 'fianza')->where('id', '=',$alquiler[0]->idAlquiler)->get();
            $alquiler[$i]->fianza = $fianza;
            $direccion = Address::select('id','idLocalidad', 'idProvincia', 'nombre_de_la_direccion','tipo_de_via')->where('idInmueble', '=',$fianza[0]->idInmueble)->get();
            $direccion->idLocalidad = Location::select('nombre')->where('id', $direccion[0]->idLocalidad)->get();
            $direccion->idProvincia = Province::select('nombre')->where('id',$direccion[0]->idProvincia)->get();
            $alquiler[$i]->direccion = $direccion;
            $precio = Property::select('precio')->where('id', '=',$fianza[0]->idInmueble)->get();
            $alquiler[$i]->precio = $precio;
        }
        return view('alquileresUsuario')->with('alquiler', $alquiler);

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
    public function store(Request $request,$id)
    {

        $alquileresRegistrados = Is_Rented::where('estado', '=', 'enviada')->get();
        $mensaje = "";
        $propetario =  Property::select('idUsuario')->where('id', $id)->get();
        $idAlquiler = Rental::select('id')->where('idInmueble', '=',$id)->get();

        if(count($alquileresRegistrados) > 0){
            $mensaje = "Ya tienes enviada una petición de alquiler";
        }else{
            $alquileresRegistrados = Is_Rented::where('estado', '=', 'Aceptada')->get();
            if(count($alquileresRegistrados) != 0){
                $mensaje = "Ya tienes dos alquileres registrados en la base de datos";
            }else{
                $alquiler = new Is_Rented;
                $alquiler->fecha_inicio = $request->fechaInicio;
                if($request->fechaDuracion == null){
                    $alquiler->fecha_final = 'Indefinido';
                }else{
                    $alquiler->fecha_final = $request->fechaDuracion;
                }
                $alquiler->numero_de_cuenta = $request->numeroCuenta;
                $alquiler->idAlquiler = $idAlquiler[0]->id;
                $alquiler->idUsuario = Auth::User()->id;
                $alquiler->estado = 'Enviada';
                $alquiler->save();

                $fecha = getdate();
                $soli = new Solicitude;
                $soli->fecha_solicitada = $fecha['year'] . '/' . $fecha['mon'] . '/' . $fecha['mday'];
                $soli->hora = "no aplica";
                $soli->estado = "Enviada";
                $propetario = Property::select('idUsuario')->where('id', $id)->get();
                $soli->solicitadaAIdUser = $propetario[0]->idUsuario;
                $soli->solicitadaDeIdUser = Auth::user()->id;
                $soli->idInmueble = $id;
                $soli->save();

                $notificacion = new Notification;
                $notificacion->fecha = $fecha['year'] . '/' . $fecha['mon'] . '/' . $fecha['mday'];
                $notificacion->titulo = 'Petición de Alquiler';
                $notificacion->leido = false;
                $notificacion->idUsuario = $propetario[0]->idUsuario;
                $notificacion->idRequest = $soli->id;
                $notificacion->save();
            }  
        }
        return $mensaje;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $precio = Property::select('precio')->where('id', $request->idInm)->get();
        $fianza = Rental::select('fianza')->where('idInmueble', $request->idInm)->get();
        return array('precio' => $precio, 'fianza'=> $fianza);
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Image;
use App\Address;
use App\Property;
use App\Is_Rented;
use App\Sale;
use App\Rental;
use App\Solicitude;
use App\Favorite;
use App\Visiting_hour;
use App\Notification;
use DB;

class datosPersonalesController extends Controller
{
    public function index()
    {
        return view('datosPersonales');
    }

    public function editarDatosPersonales($id)
    {
        return view('editarPerfil')->with('user', User::where('id', '=', $id)->first());
    }

    public function update(Request $request)
    {
        $user = User::find($request->idUsuario);
        $user->nif_nie = $request->nif_nie;
        $user->nombre = $request->name;
        $user->sexo = $request->sexo;
        $user->primer_apellido = $request->primerApellido;
        $user->segundo_apellido = $request->segundoApellido;
        if($request->rol != null){
            $user->rol = $request->rol;   
        }
        $user->telefono = $request->telefono;
        $user->email = $request->email;
        $user->fecha_nacimiento = $request->fechaNacimiento;
        $user->save();

        return redirect('/perfil/datosPersonales');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class datosPersonalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('datosPersonales');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editarDatosPersonales()
    {
        return view('editarPerfil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function traerDatos(){
        $user = User::find(Auth::User()->id);
        return $user;
    }

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

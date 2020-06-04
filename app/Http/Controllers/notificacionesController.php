<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Illuminate\Support\Facades\Auth;

class notificacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification ="";
        if(Auth::user() != null){
            $notification = Notification::where('idUsuario', '=', Auth::user()->id)->where('leido', '=', false)->get();
        }
        return $notification;
    }

    public function mostrarVista(){
        $notification = Notification::where('idUsuario', '=', Auth::user()->id)->orderBy('fecha', 'DESC')->get();
        return view('notificacion')->with("notificacion", $notification);
    }

    public function destroy($id)
    {
        Notification::destroy($id);
    }
}

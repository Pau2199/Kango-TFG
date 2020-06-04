<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(isset($_COOKIE['favoritos'])){
            if(Auth::check()){
                $array = explode(',', $_COOKIE['favoritos']);
                for($i = 0 ; $i<count($array); $i++){
                    $id = explode('-', $array[$i]);
                    $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $id[1])->get();
                    if(count($favorito) == 0){
                        $fav = new Favorite;
                        $fav->idUser = Auth::User()->id;
                        $fav->idInmueble = $id[1];
                        $fav->save(); 
                    }
                }
                setcookie('favoritos', 'eliminar', time()-2000);
            }
        }
        return redirect('/');

    }
}

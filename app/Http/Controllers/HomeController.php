<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(isset($_COOKIE['favoritos'])){
            if(Auth::check()){
                $array = explode(',', $_COOKIE['favoritos']);
                for($i = 0 ; $i<count($array); $i++){
                    $favorito = Favorite::where('idUser', '=', Auth::User()->id)->where('idInmueble', '=', $array[$i])->get();
                    if(count($favorito) == 0){
                        $fav = new Favorite;
                        $fav->idUser = Auth::User()->id;
                        $fav->idInmueble = $array[$i];
                        $fav->save(); 
                    }
                }
                setcookie('favoritos', 'eliminar', time()-2000);
            }
        }
        return redirect('/');

    }
}

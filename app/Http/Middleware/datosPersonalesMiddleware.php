<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class datosPersonalesMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $_SERVER["REQUEST_URI"];
        $id = explode('/', $id);


        if(Auth::check() && (Auth::User()->rol == 'Admin' || Auth::User()->id == $id[3])){
            return $next($request);   
        }else{
            return redirect('/');   
        }
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class PagoMiddleware
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
        if(isset($_COOKIE['alquila']) && auth()->check()){
            return $next($request);   
        }else{
            return redirect('/');   
        }
    }
}

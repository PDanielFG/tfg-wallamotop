<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(auth()->check()){
            if(auth()->user()->role=='admin'){      //Esto hace que solo pueda acceder a /admin el usuairo que especifiquemos nosotros en la bd
                return $next($request);
            }
        }
        return redirect()->to('/');

    }
}

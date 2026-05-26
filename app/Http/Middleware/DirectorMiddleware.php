<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DirectorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //nos permite revisar que este autenticado el usuario, saca el rol y compara si es igual a enfermeria, si no lanza un abort
        if (
        auth()->check() &&
        auth()->user()->rol === 'director'
        ) {
        return $next($request);
    }

        abort(403);
    }
}

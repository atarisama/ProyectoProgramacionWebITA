<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnfermeriaMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    //nos permite revisar que este autenticado el usuario, saca el rol y compara si es igual a enfermeria, si no lanza un abort
    public function handle(Request $request, Closure $next): Response
    {
        if (
        auth()->check() &&
        auth()->user()->rol === 'enfermeria'
        ) {
        return $next($request);
        }
        abort(403);
    }
}

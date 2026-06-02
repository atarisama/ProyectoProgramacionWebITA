<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $roles): Response
    {
        if (! auth()->check()) {
            abort(403);
        }

        $allowedRoles = array_map('trim', explode(',', $roles));

        if (! in_array(auth()->user()->rol, $allowedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}

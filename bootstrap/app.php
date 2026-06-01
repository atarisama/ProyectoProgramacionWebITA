<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    //registramos los middlewares para poder utilizar el de director y enfermeria
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'director' => \App\Http\Middleware\DirectorMiddleware::class,
            'enfermeria' => \App\Http\Middleware\EnfermeriaMiddleware::class,
            'medico' => \App\Http\Middleware\MedicoMiddleware::class,
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectTo(
            guests: '/admin/login',
            users: function ($request) {
            // Example of inline handling for roles after authenticating
            if ($request->user()->role == 'owner') {
                return '/owner/dashboard';
            } elseif ($request->user()->role == 'kasir') {
                return '/kasir/dashboard';
            } elseif ($request->user()->role == 'dapur') {
                return '/dapur/dashboard';
            } else {
                return '/admin/dashboard'; // Default for other authenticated users
            }
        }
        );

        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

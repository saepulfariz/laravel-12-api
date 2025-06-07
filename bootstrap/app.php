<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function ($exceptions) {
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
            // Custom logic for when exceptions should be rendered as JSON
            if ($request->is('api/*')) {
                return true; // Always render JSON for 'api/*' routes
            }

            // Or The standard behavior is to only show JSON if the request is for JSON.
            return $request->expectsJson();
        });
    })->create();

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isVerified' => \App\Http\Middleware\IsVerified::class,
            'isTrust' => \App\Http\Middleware\CanAccessApis::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $exception) {
            if ($exception instanceof ThrottleRequestsException) {
                return response()->json([
                    'status' => false,
                    'message' => 'Too many requests. Please try again later',
                    'data' => [],
                ], 429);
            }
        });
    })
    ->withProviders()
    ->create();

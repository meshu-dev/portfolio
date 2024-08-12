<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__ . '/../routes/api.php',
        apiPrefix: '',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up'
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Exception $exception, Request $request) {
            if ($request->is('*')) {
                return response()->json(
                    [
                        'message' => $exception->getMessage()
                    ],
                    $exception->getCode() >= 400 ? (int) $exception->getCode() : 406
                );
            }
        });
    })->create();

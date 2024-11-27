<?php

use App\Http\Middleware\IsActive;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsLoggedIn;
use App\Http\Middleware\IsVerified;
use App\Http\Middleware\NotLoggedIn;
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
        $middleware->alias([
            'authenticated' => IsLoggedIn::class,
            'unauthenticated' => NotLoggedIn::class,
            'admin' => IsAdmin::class,
            'active' => IsActive::class,
            'verified' => IsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

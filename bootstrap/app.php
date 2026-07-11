<?php

use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    // Configure application routing.
    // The `web` routes specified here automatically have the default web middleware group applied,
    // which initializes the session lifecycle, cookie encryption, CSRF protection, and shared view errors.
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // Configure global or route-specific middleware alias definitions.
    ->withMiddleware(function (Middleware $middleware): void {
        // Registers middleware aliases. Custom role checks utilize the authenticated session's user state.
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

<?php

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureEmailIsVerified;
use App\Http\Middleware\HandleImpersonation;
use App\Http\Middleware\HandleInertiaRequests;
use App\Http\Middleware\RequirePassword;
use App\Http\Middleware\SecureHttpHeaders;
use App\Http\Middleware\SetLocale;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'auth' => Authenticate::class,
            'password.confirm' => RequirePassword::class,
            'verified' => EnsureEmailIsVerified::class,
        ]);

        $middleware->web(append: [
            SetLocale::class,
            HandleImpersonation::class,
            HandleInertiaRequests::class,
            AddLinkHeadersForPreloadedAssets::class,
        ]);

        $middleware->append(SecureHttpHeaders::class);
    })

    ->withEvents(discover: [
        //
    ])

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

    ->create();

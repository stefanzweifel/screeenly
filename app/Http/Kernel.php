<?php

namespace Screeenly\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        Illuminate\Cookie\Middleware\EncryptCookies::class,
        Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        Illuminate\Session\Middleware\StartSession::class,
        Illuminate\View\Middleware\ShareErrorsFromSession::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                   => Screeenly\Http\Middleware\Authenticate::class,
        'auth.basic'             => Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest'                  => Screeenly\Http\Middleware\RedirectIfAuthenticated::class,
        'csrf'                   => Screeenly\Http\Middleware\VerifyCsrfToken::class,
        'api.auth'               => Screeenly\Http\Middleware\ApiAuth::class,
        'api.throttle'           => Screeenly\Http\Middleware\ApiThrottle::class,
        'app.hasEmail'           => Screeenly\Http\Middleware\UserHasEmail::class,
        'api.accept_json_header' => Screeenly\Core\Middleware\AddAcceptJsonHeader::class
    ];
}

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
        'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
        'Illuminate\Cookie\Middleware\EncryptCookies',
        'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
        'Illuminate\Session\Middleware\StartSession',
        'Illuminate\View\Middleware\ShareErrorsFromSession',
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => 'Screeenly\Http\Middleware\Authenticate',
        'auth.basic' => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
        'guest' => 'Screeenly\Http\Middleware\RedirectIfAuthenticated',
        'csrf' => 'Screeenly\Http\Middleware\VerifyCsrfToken',
        'api.auth' => 'Screeenly\Http\Middleware\ApiAuth',
        'api.throttle' => 'Screeenly\Http\Middleware\ApiThrottle',
        'app.hasEmail' => 'Screeenly\Http\Middleware\UserHasEmail',
    ];
}

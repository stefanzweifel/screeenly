<?php

namespace Screeenly\Http\Middleware;

use Closure;
use Screeenly\User;
use Illuminate\Foundation\Application;

class ApiAuth
{
    /**
     * Application implementation.
     *
     * @var Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Create a new filter instance.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $key = $request->get('key');

        if (is_null($key)) {
            return abort(401, 'No API Key specified.');
        }

        if (!User::getUserByKey($key)) {
            return abort(403, 'Access denied.');
        }

        return $next($request);
    }
}

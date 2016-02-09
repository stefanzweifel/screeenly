<?php

namespace Screeenly\Http\Middleware;

use Closure;
use Exception;
use Screeenly\Core\Exception\InvalidApiKeyException;
use Screeenly\User;

class ApiAuth
{
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
            throw new Exception('No API Key specified.', 401);
        }

        if (! User::getUserByKey($key)) {
            throw new InvalidApiKeyException('Access denied.', 403);
        }

        return $next($request);
    }
}

<?php

namespace Screeenly\Core\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\HeaderBag;

class AddAcceptJsonHeader
{
    /**
     * Add Json HTTP_ACCEPT header for an incoming request.
     * Kudos: http://stackoverflow.com/q/31507849/2646818
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->server->set('HTTP_ACCEPT', 'application/json');
        $request->headers = new HeaderBag($request->server->getHeaders());
        return $next($request);
    }
}

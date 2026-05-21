<?php

namespace Screeenly\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class CheckSunsetDate
{
    public function handle(Request $request, Closure $next)
    {
        if (now()->gte(Carbon::parse(config('screeenly.sunset_date')))) {
            return response()->json([
                'message' => 'This open source version of screeenly has been shut down and the API is no longer available. Switch to our paid version (https://3.screeenly.com/) or host this application on your own servers (https://github.com/stefanzweifel/screeenly/wiki/Requirements-and-Install)',
            ], 410);
        }

        return $next($request);
    }
}

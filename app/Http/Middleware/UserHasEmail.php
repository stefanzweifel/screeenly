<?php

namespace Screeenly\Http\Middleware;

use Closure;
use Auth;
use Session;

class UserHasEmail
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
        $user = Auth::user();

        if (empty($user->email)) {
            Session::put('requestedPath', $request->path());

            return redirect()->route('app.storeEmailForm');
        }

        return $next($request);
    }
}

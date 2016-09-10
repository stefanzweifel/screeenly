<?php

namespace App\Http\Middleware;

use Closure;

class AccountHasEmailAddress
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->email == '') {
            return redirect('/setup/email');
        }

        return $next($request);
    }
}

<?php

namespace Hermes\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class RedirectIfNotApproved
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
        if ( ($request->user()->status === 'W') || ($request->user()->status === 'D') ) {
            Auth::logout();
            return redirect('/');
        }

        return $next($request);
    }
}

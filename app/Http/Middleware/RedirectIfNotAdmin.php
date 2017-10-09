<?php

namespace Hermes\Http\Middleware;

use Closure;

class RedirectIfNotAdmin
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
        if ( $request->user()->category !== 'ADMIN')
            return redirect('/');
        return $next($request);
    }
}

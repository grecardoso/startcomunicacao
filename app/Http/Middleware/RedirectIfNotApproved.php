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
            $status = $request->user()->status === 'W' ? 'warning' : 'danger';
            $msg = "";
            $email = $request->user()->email;

            if ( $request->user()->status === 'W' ) {
                $msg = "Usuário aguardando aprovação pelos administradores.";
            } else {
                $msg = "Usuário com acesso bloqueado. Contate o suporte.";
            }

            Auth::logout();
            return redirect('/')->with([
                'msg' => $msg,
                'status' => $status
            ]);
        }

        return $next($request);
    }
}

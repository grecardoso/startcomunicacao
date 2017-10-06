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
                $msg = "Usuário $email aguardando aprovação pelos administradores.";
            } else {
                $msg = "Usuário $email com acesso bloqueado. Contate o suporte.";
            }

            Auth::logout();
            return redirect('/login')->with([
                'msg' => $msg,
                'status' => $status
            ]);
        }

        return $next($request);
    }
}

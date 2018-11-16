<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            switch (Auth::user()->role->nombre) {
                case 'Administrador': return redirect('/admin/usuarios');
                case 'Recepcionista': return redirect ('/pacientes');
                case 'Médico': return redirect ('/turnos');
            }
            return redirect('/');
        }

        return $next($request);
    }
}

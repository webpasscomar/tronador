<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // chequeo si el usuario esta autenticado
        if (Auth::check()) {
            //cargo los roles de ese usuario autenticado, según las relaciones definidas en los modelos
            $user = Auth::user()->load('roles');
            // Si el usuario no tiene el rol Administrador lo redirijo al dashboard
            if (!$user->roles->contains('name', 'Administrador')) {
                return redirect()->route('admin.dashboard');
            }
        }
        return $next($request);
    }
}
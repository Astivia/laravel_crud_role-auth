<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roleOrPermission): Response
    {
        if (!auth()->check()) {
            abort(403, 'Acceso Denegado.');
        }

        $user = auth()->user();

        // Verificar si el usuario tiene el rol solicitado o el permiso solicitado
        if ($user->hasRole($roleOrPermission) || $user->hasPermission($roleOrPermission)) {
            return $next($request);
        }

        // Si no cumple ninguna condición, retornar error 403
        abort(403, 'No tienes permiso para acceder a esta sección.');
    }
}

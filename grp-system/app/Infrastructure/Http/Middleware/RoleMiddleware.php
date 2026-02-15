<?php

namespace App\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // Si no hay usuario autenticado
        if (! $user) {
            return response()->json(['message' => 'No autenticado'], 401);
        }

        // Si el rol del usuario no está en la lista de roles permitidos
        if (! in_array($user->role->name, $roles)) {
            return response()->json(['message' => 'Acceso denegado'], 401);
        }

        return $next($request);
    }
}

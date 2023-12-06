<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    // Vérifiez si la route est différente de 'annonce/incidentsave/{id}'
    if ($request->is('annonce/incidentsave/*')) {
        // Si la route est 'annonce/incidentsave/{id}', passez la requête sans les en-têtes CORS
        return $next($request);
    }

    // Si la route n'est pas 'annonce/incidentsave/{id}', ajoutez les en-têtes CORS
    return $next($request)
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Accept, Authorization, X-Requested-With');
}
    
}

<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class Cors
{
    public function handle(Request $request, Closure $next)
    {
        return next($request)
        // Establecemos la cabecera CORS para permitir el origen de solicitud desde localhost
        ->header('Access-Control-Allow-Origin', '*'); // cualquier origen
    }
}
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class apiProtectRoutes extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                return response()->json(['message' => 'Token invalido'], 401);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                return response()->json(['message' => 'Token expirado'], 401);
            } else {
                return response()->json(['message' => 'Token de autorização não encontrado'], 401);
            }
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {

            $user = JWTAuth::parseToken()->authenticate();

        } catch (Exception $e) {

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return (new Helper())->sendErrorResponse('Token is Invalid.', $e->getMessage(), $e->getCode());
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return (new Helper())->sendErrorResponse('Token is Expired.', $e->getMessage(), $e->getCode());
            } else {
                return (new Helper())->sendErrorResponse('Authorization Token not found.', $e->getMessage(), $e->getCode());
            }
        }
        return $next($request);
    }
}

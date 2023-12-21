<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use Closure;
use Spatie\FlareClient\Http\Exceptions\NotFound;
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

            if (!empty($user)) {
                return $next($request);
            }

            return response()->json([
                'success' => false,
                'statusCode' => 500,
                'message' => 'Authorization Token not found.'
            ]);

        } catch (Exception $e) {

            $response = [
                'success' => false,
                'statusCode' => 500,
                'message' => 'Authorization Token not found.'
            ];

            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {

                $response['message'] = 'Token is Invalid.';
                return response()->json($response);

            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {

                $response['message'] = 'Token is Expired.';
                return response()->json($response);

            } else {
                return response()->json($response);
            }
        }
    }
}

<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    public function login(LoginRequest $loginRequest): JsonResponse
    {
        $credentials = $loginRequest->only('email', 'password');

        //Create token
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return (new Helper())->sendErrorResponse('Login credentials are invalid.', 'Validation Error.', 400);
            }

            //Token created, return with success response and jwt token
            return (new Helper())->sendSuccessResponse(200, 'Login successfully', 'token', $token);

        } catch (JWTException $e) {
            return (new Helper())->sendErrorResponse('Could not create token.', $e->getMessage(), 500);
        }
    }
}

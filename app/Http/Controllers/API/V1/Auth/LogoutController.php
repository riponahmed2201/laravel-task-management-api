<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LogoutRequest;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function logout(LogoutRequest $logoutRequest)
    {
        //Request is validated, do logout
        try {
            JWTAuth::invalidate($logoutRequest->token);

            return (new Helper())->sendSuccessResponse(200, 'User has been logged out.');

        } catch (JWTException $exception) {
            return (new Helper())->sendErrorResponse('Sorry, user cannot be logged out.', $exception->getMessage(), 500);
        }
    }
}

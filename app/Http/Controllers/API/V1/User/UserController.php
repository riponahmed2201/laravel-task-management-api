<?php

namespace App\Http\Controllers\API\V1\User;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }

    public function getUserByToken(): JsonResponse
    {
        try {

            //Pass to the user service
            $user = $this->userService->getUserByToken();

            return (new Helper())->sendSuccessResponse(200, 'User info fetch successfully.', 'user', $user);
        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('User not found.', $exception->getMessage(), $exception->getCode());
        }
    }
}

<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\DataTransferObject\RegisterDto;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\RegisterRequest;
use App\Services\Auth\RegisterService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{
    public function __construct(protected RegisterService $registerService)
    {
    }
    public function register(RegisterRequest $registerRequest) :JsonResponse
    {
        try {

            //Pass to register service
            $this->registerService->registerUser(RegisterDto::fromApiRequest($registerRequest));

            return (new Helper())->sendSuccessResponse(201, 'User created successfully.');

        } catch (\Exception $exception) {
            return (new Helper())->sendErrorResponse('User was not created.', $exception->getMessage(), $exception->getCode());
        }
    }
}

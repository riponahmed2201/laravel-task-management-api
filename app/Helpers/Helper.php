<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class Helper
{
    public function sendSuccessResponse(int $statusCode, string $message, string $keyOfData = null, $data = null): JsonResponse
    {
        $responseResult = [
            'success' => true,
            'statusCode' => $statusCode,
            'message' => $message
        ];

        if (!empty($keyOfData) && !empty($data)) $responseResult[$keyOfData] = $data;
        if (empty($keyOfData) && !empty($data)) $responseResult = [...$responseResult, ...$data];

        return response()->json($responseResult, $statusCode);
    }

    public function sendErrorResponse(string $message, string|array $errorMessages, int $statusCode = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'statusCode' => $statusCode,
            'message' => $message
        ];

        if (!empty($errorMessages)) {
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $statusCode);
    }
}

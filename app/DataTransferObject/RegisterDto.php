<?php

namespace App\DataTransferObject;

use App\Http\Requests\Api\RegisterRequest;

class RegisterDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly string $status,
    )
    {

    }

    public static function fromApiRequest(RegisterRequest $registerRequest): RegisterDto
    {
        return new self (
            name: $registerRequest->validated('name'),
            email: $registerRequest->validated('email'),
            password: $registerRequest->validated('password'),
            status: $registerRequest->validated('status'),
        );
    }
}

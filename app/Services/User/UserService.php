<?php

namespace App\Services\User;

use Illuminate\Database\Eloquent\Collection;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService
{
    public function getUserByToken()
    {
        return JWTAuth::parseToken()->authenticate();
    }
}

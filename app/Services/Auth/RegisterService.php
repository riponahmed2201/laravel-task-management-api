<?php

namespace App\Services\Auth;

use App\DataTransferObject\RegisterDto;
use App\DataTransferObject\TaskDto;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class RegisterService
{
    public function registerUser(RegisterDto $registerDto)
    {
        return User::create([
            'name' => $registerDto->name,
            'email' => $registerDto->email,
            'password' => Hash::make($registerDto->password),
            'role' => $registerDto->role,
        ]);
    }
}

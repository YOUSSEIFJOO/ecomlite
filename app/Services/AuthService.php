<?php

namespace App\Services;

use App\Http\Resources\Users\ReadResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login($data): array
    {
        $user = User::where('email', $data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            $token = $user->createToken('EcomLite')->plainTextToken;

            return [
                'token' => $token,
                'user' => ReadResource::make($user)
            ];
        }

        return [];
    }
}

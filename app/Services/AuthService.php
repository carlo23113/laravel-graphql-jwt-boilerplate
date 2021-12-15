<?php

namespace App\Services;

use App\Models\User;

class AuthService {
    
    public function validateLogin(String $email, String $password): array
    {
        $result = [
            'success' => false,
            'data' => []
        ];

        $credentials = [
            'email' => $email,
            'password' => $password
        ];

        $userInfo = User::where(['email' => $email])->first();
        $token = auth()->attempt($credentials);

        if($token) {
            $result = [
                'success' => true,
                'data' => $this->respondWithToken($token)
            ];
        }

        return $result;
    }

    public function respondWithToken(String $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
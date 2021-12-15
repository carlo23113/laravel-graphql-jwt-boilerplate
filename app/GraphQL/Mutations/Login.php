<?php

namespace App\GraphQL\Mutations;

use App\GraphQL\Types\Error;
use App\GraphQL\Types\LoginPayload;
use App\Services\AuthService;

class Login
{

    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }
    
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke($_, array $args)
    {
        $email = $args['email'];
        $password = $args['password'];

        $validate = $this->authService->validateLogin($email, $password);

        if(!$validate['success']) {
            return new Error([
                'message' => 'Incorrect email or password.'
            ]);
        }
        
        return new LoginPayload($validate['data']);
    }

}
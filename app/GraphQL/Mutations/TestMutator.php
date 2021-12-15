<?php

namespace App\GraphQL\Mutations;

use App\Services\TestService;

class TestMutator
{
    private $testService;

    public function __construct()
    {
        $this->testService = new TestService();
    }
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        return $this->testService->create($args); 
    }
}
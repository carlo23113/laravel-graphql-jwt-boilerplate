<?php

namespace App\Services;

use App\GraphQL\Types\Error;
use App\GraphQL\Types\Success;
use App\Models\Test;
use Throwable;

class TestService
{

    private $test;

    public function __construct()
    {
        $this->test = new Test();
    }

    public function create($args): object
    {
        try {
            app('db')->beginTransaction();
            $this->test->test_name = $args['test_name'];
            $this->test->test_description = $args['test_description'];
            $this->test->save();
        } catch (Throwable $t) {
            app('db')->rollBack();
            
            return new Error([
                'message' => 'Something went wrong. Failed to save BCO Admin'
            ]);
        }

        app('db')->commit();

        return new Success([
            'message' => 'Test created successfully'
        ]);
            
    }
}
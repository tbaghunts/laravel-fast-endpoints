<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\Throttle;

use Tests\Unit\Attributes\Abstract\TestCase;

class ThrottleTest extends TestCase
{
    protected function getNamespace(): string
    {
        return Throttle::class;
    }

    public function test_withoutPramsCase()
    {
        $this->getInstance();
        $this->assertEquals([
            [
                "requests" => 60,
                "perMinute" => 1,
            ]
        ], $this->endpointConfig->getThrottles());
    }

    public function test_withRequestsParamCase()
    {
        $this->getInstance([
            "requests" => 20,
        ]);

        $this->assertEquals([
            [
                "requests" => 20,
                "perMinute" => 1,
            ]
        ], $this->endpointConfig->getThrottles());
    }

    public function test_withFullParamCase()
    {
        $this->getInstance([
            "requests" => 20,
            "perMinute" => 2,
        ]);

        $this->assertEquals([
            [
                "requests" => 20,
                "perMinute" => 2,
            ]
        ], $this->endpointConfig->getThrottles());
    }

    public function test_withRepeatedParamCase()
    {
        $this->getInstance([
            "requests" => 20,
            "perMinute" => 2,
        ]);
        $this->getInstance([
            "requests" => 10,
            "perMinute" => 5,
        ]);
        $this->assertEquals([
            [
                "requests" => 20,
                "perMinute" => 2,
            ],
            [
                "requests" => 10,
                "perMinute" => 5,
            ]
        ], $this->endpointConfig->getThrottles());
    }
}
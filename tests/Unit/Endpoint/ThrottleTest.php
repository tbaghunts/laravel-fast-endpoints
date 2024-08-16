<?php

namespace Tests\Unit\Endpoint;

use Tests\Unit\Endpoint\Abstract\EndpointConfigTestCase;

class ThrottleTest extends EndpointConfigTestCase
{
    public function test_defaultCase()
    {
       $this->assertEmpty($this->endpointConfig->getThrottles());
    }

    public function test_singleUsageCase()
    {
        $this->endpointConfig->setThrottle(1, 2);

        $this->assertEquals([
            [
                'requests' => 1,
                'perMinute' => 2,
            ]
        ], $this->endpointConfig->getThrottles());
    }

    public function test_multipleUsageCase()
    {
        $this->endpointConfig->setThrottle(1, 2);
        $this->endpointConfig->setThrottle(3, 4);

        $this->assertEquals([
            [
                'requests' => 1,
                'perMinute' => 2,
            ],
            [
                'requests' => 3,
                'perMinute' => 4,
            ]
        ], $this->endpointConfig->getThrottles());
    }
}
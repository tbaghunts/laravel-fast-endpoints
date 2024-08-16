<?php

namespace Tests\Unit\Attributes;

use Baghunts\LaravelFastEndpoint\Attributes\WithoutThrottle;

use Tests\Unit\Attributes\Abstract\TestCase;

class WithoutThrottleTest extends TestCase
{
    protected function getNamespace(): string
    {
        return WithoutThrottle::class;
    }

    public function test_defaultCase()
    {
        $this->getInstance();
        $this->assertEquals(['throttle:60,1'], $this->endpointConfig->getWithoutMiddleware());

    }

    public function test_withNameCase()
    {
        $this->getInstance([
            'requests' => 'custom.throttle'
        ]);
        $this->assertEquals([
            'custom.throttle'
        ], $this->endpointConfig->getWithoutMiddleware());
    }

    public function test_configsMergeCase()
    {
        $this->endpointConfig->setWithoutMiddleware([
            'without-middleware-1',
            'without-middleware-2',
        ]);

        $this->getInstance([
            'requests' => 'download.throttle'
        ]);
        $this->assertEquals([
            'without-middleware-1',
            'without-middleware-2',
            'download.throttle'
        ], $this->endpointConfig->getWithoutMiddleware());
    }

    public function test_repeatableCase()
    {
        $this->getInstance([
            'requests' => 2,
            'perMinute' => 2,
        ]);
        $this->getInstance([
            'requests' => 'upload.throttle',
        ]);

        $this->assertEquals([
            'throttle:2,2',
            'upload.throttle',
        ], $this->endpointConfig->getWithoutMiddleware());
    }
}
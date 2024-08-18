<?php

namespace Tests\Unit\Endpoint\Abstract;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoints\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;

abstract class EndpointConfigTestCase extends TestCase
{
    protected EndpointConfigContract $endpointConfig;

    protected function setUp(): void
    {
        $this->endpointConfig = app(EndpointConfig::class, $this->getInitialConfig());
    }

    protected function getInitialConfig(): array
    {
        return [];
    }
}
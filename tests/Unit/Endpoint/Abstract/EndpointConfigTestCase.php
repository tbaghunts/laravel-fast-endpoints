<?php

namespace Tests\Unit\Endpoint\Abstract;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

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
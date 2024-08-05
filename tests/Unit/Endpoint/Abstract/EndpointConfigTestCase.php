<?php

namespace Tests\Unit\Endpoint\Abstract;

use Orchestra\Testbench\TestCase;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
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
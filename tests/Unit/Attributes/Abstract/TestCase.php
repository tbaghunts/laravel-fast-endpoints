<?php

namespace Tests\Unit\Attributes\Abstract;

use Orchestra\Testbench\TestCase as TestbenchTestCase;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointAttributeContract;

abstract class TestCase extends TestbenchTestCase
{
    public ?EndpointConfigContract $endpointConfig;

    protected abstract function getNamespace(): string;


    protected function setUp(): void
    {
        $this->endpointConfig = new EndpointConfig();
    }


    protected function getInstance(array $args = []): EndpointConfigContract
    {
        /**
         * @var  $instance EndpointAttributeContract
         */
        $instance = app(
            $this->getNamespace(),
            $args
        );
        $instance->apply($this->endpointConfig);

        return $this->endpointConfig;
    }
}
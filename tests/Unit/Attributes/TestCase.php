<?php

namespace Tests\Unit\Attributes;

use Orchestra\Testbench\TestCase as TestbenchTestCase;

use Baghunts\LaravelFastEndpoint\Endpoint\EndpointConfig;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointAttributeContract;

abstract class TestCase extends TestbenchTestCase
{
    public ?EndpointConfig $endpointConfig;

    protected abstract function getNamespace(): string;

    public function getInstance(array $args = []): EndpointConfig
    {
        $this->endpointConfig = new EndpointConfig();

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
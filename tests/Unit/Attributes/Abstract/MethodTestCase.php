<?php

namespace Tests\Unit\Attributes\Abstract;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

abstract class MethodTestCase extends TestCase
{
    protected function getInstance(array $args = []): EndpointConfigContract
    {
        $this->endpointConfig->setMethod([]);
        $this->endpointConfig->setPath("fake/path");

        $instance = app($this->getNamespace(), [
            "path"  => $this->getPathArg()
        ]);
        $instance->apply($this->endpointConfig);

        return $this->endpointConfig;
    }

    protected function getPathArg(): string
    {
        return "/path/to/any";
    }
}
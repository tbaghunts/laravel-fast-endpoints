<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereNumber
{
    public function getWhereNumber(): array
    {
        return $this->whereNumber;
    }

    public function setWhereNumber(array $whereNumber): EndpointConfigContract
    {
        $this->whereNumber = $whereNumber;
        return $this;
    }
    public function addWhereNumber(array|string $parameters): EndpointConfigContract
    {
        collect($parameters)->each(function(string $parameter) {
            $this->whereNumber[] = $parameter;
        });

        return $this;
    }
}
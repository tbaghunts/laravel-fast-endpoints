<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereNumber
{
    public function getWhereNumber(): array
    {
        return $this->whereNumber;
    }

    public function setWhereNumber(array|string $whereNumber): EndpointConfigContract
    {
        $this->whereNumber = collect($whereNumber)->toArray();
        return $this;
    }
    public function addWhereNumber(array|string $parameters): EndpointConfigContract
    {
        $this->whereNumber = array_merge($this->whereNumber, collect($parameters)->toArray());
        return $this;
    }
}
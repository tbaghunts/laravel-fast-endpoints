<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereUlid
{
    public function getWhereUlid(): array
    {
        return $this->whereUlid;
    }

    public function setWhereUlid(array $whereUlid): EndpointConfigContract
    {
        $this->whereUlid = $whereUlid;
        return $this;
    }
    public function addWhereUlid(array|string $parameters): EndpointConfigContract
    {
        collect($parameters)->each(function(string $parameter) {
            $this->whereUlid[] = $parameter;
        });
        return $this;
    }
}
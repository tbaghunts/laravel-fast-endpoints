<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereUuid
{
    public function getWhereUuid(): array
    {
        return $this->whereUuid;
    }

    public function setWhereUuid(array $whereUuid): EndpointConfigContract
    {
        $this->whereUuid = $whereUuid;
        return $this;
    }
    public function addWhereUuid(array|string $parameters): EndpointConfigContract
    {
        collect($parameters)->each(function (string $parameter) {
            $this->whereUuid[] = $parameter;
        });

        return $this;
    }
}
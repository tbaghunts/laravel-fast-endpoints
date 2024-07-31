<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereUuid
{
    public function getWhereUuid(): array
    {
        return $this->whereUuid;
    }

    public function setWhereUuid(array|string $whereUuid): EndpointConfigContract
    {
        $this->whereUuid = collect($whereUuid)->toArray();
        return $this;
    }
    public function addWhereUuid(array|string $parameters): EndpointConfigContract
    {
        $this->whereUuid = array_merge($this->whereUuid, collect($parameters)->toArray());
        return $this;
    }
}
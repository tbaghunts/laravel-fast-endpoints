<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereUlid
{
    public function getWhereUlid(): array
    {
        return $this->whereUlid;
    }

    public function setWhereUlid(array|string $whereUlid): EndpointConfigContract
    {
        $this->whereUlid = collect($whereUlid)->toArray();
        return $this;
    }
    public function addWhereUlid(array|string $parameters): EndpointConfigContract
    {
        $this->whereUlid = array_merge($this->whereUlid, collect($parameters)->toArray());
        return $this;
    }
}
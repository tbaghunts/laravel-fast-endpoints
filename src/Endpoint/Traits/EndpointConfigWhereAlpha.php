<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereAlpha
{
    public function getWhereAlpha(): array
    {
        return $this->whereAlpha;
    }

    public function setWhereAlpha(array|string $whereAlpha): EndpointConfigContract
    {
        $this->whereAlpha = collect($whereAlpha)->toArray();
        return $this;
    }
    public function addWhereAlpha(array|string $parameters): EndpointConfigContract
    {
        $this->whereAlpha = array_merge($this->whereAlpha, collect($parameters)->toArray());
        return $this;
    }
}
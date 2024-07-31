<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereAlphaNumeric
{
    public function getWhereAlphaNumeric(): array
    {
        return $this->whereAlphaNumeric;
    }

    public function setWhereAlphaNumeric(array|string $whereAlphaNumeric): EndpointConfigContract
    {
        $this->whereAlphaNumeric = collect($whereAlphaNumeric)->toArray();
        return $this;
    }
    public function addWhereAlphaNumeric(array|string $parameters): EndpointConfigContract
    {
        $this->whereAlphaNumeric = array_merge($this->whereAlphaNumeric, collect($parameters)->toArray());
        return $this;
    }
}
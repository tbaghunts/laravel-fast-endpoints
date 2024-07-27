<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereAlphaNumeric
{
    public function getWhereAlphaNumeric(): array
    {
        return $this->whereAlphaNumeric;
    }

    public function setWhereAlphaNumeric(array $whereAlphaNumeric): EndpointConfigContract
    {
        $this->whereAlphaNumeric = $whereAlphaNumeric;
        return $this;
    }
    public function addWhereAlphaNumeric(array|string $parameters): EndpointConfigContract
    {
        collect($parameters)->each(function(string $parameter) {
            $this->whereAlphaNumeric[] = $parameter;
        });

        return $this;
    }
}
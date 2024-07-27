<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereAlpha
{
    public function getWhereAlpha(): array
    {
        return $this->whereAlpha;
    }

    public function setWhereAlpha(array $whereAlpha): EndpointConfigContract
    {
        $this->whereAlpha = $whereAlpha;
        return $this;
    }
    public function addWhereAlpha(array|string $parameters): EndpointConfigContract
    {
        collect($parameters)->each(function(string $parameter) {
            $this->whereAlpha[] = $parameter;
        });

        return $this;
    }
}
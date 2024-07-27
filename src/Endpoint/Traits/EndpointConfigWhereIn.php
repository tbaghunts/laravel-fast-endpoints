<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

trait EndpointConfigWhereIn
{
    public function getWhereIn(): array
    {
        return $this->whereIn;
    }

    public function setWhereIn(array $whereIn): EndpointConfigContract
    {
        $this->whereIn = $whereIn;
        return $this;
    }
    public function addWhereIn(array|string $parameters, array $values): EndpointConfigContract
    {
        $this->whereIn[] = [
            $parameters,
            $values,
        ];
        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Illuminate\Support\Arr;

trait WhereNumber
{
    public function getWhereNumber(): array
    {
        return $this->whereNumber;
    }

    public function setWhereNumber(array|string $whereNumber): self
    {
        $this->whereNumber = Arr::wrap($whereNumber);
        return $this;
    }
    public function addWhereNumber(array|string $parameters): self
    {
        $this->whereNumber = array_merge($this->whereNumber, Arr::wrap($parameters));
        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

trait WhereUuid
{
    public function getWhereUuid(): array
    {
        return $this->whereUuid;
    }

    public function setWhereUuid(array|string $whereUuid): self
    {
        $this->whereUuid = Arr::wrap($whereUuid);
        return $this;
    }
    public function addWhereUuid(array|string $parameters): self
    {
        $this->whereUuid = array_merge($this->whereUuid, Arr::wrap($parameters));
        return $this;
    }
}
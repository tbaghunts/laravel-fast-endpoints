<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Illuminate\Support\Arr;

trait WhereUlid
{
    public function getWhereUlid(): array
    {
        return $this->whereUlid;
    }

    public function setWhereUlid(array|string $whereUlid): self
    {
        $this->whereUlid = Arr::wrap($whereUlid);
        return $this;
    }
    public function addWhereUlid(array|string $parameters): self
    {
        $this->whereUlid = array_merge($this->whereUlid, Arr::wrap($parameters));
        return $this;
    }
}
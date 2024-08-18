<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

trait WhereAlpha
{
    public function getWhereAlpha(): array
    {
        return $this->whereAlpha;
    }

    public function setWhereAlpha(array|string $whereAlpha): self
    {
        $this->whereAlpha = Arr::wrap($whereAlpha);
        return $this;
    }
    public function addWhereAlpha(array|string $parameters): self
    {
        $this->whereAlpha = array_merge($this->whereAlpha, Arr::wrap($parameters));
        return $this;
    }
}
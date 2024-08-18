<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

trait WhereAlphaNumeric
{
    public function getWhereAlphaNumeric(): array
    {
        return $this->whereAlphaNumeric;
    }

    public function setWhereAlphaNumeric(array|string $whereAlphaNumeric): self
    {
        $this->whereAlphaNumeric = Arr::wrap($whereAlphaNumeric);
        return $this;
    }
    public function addWhereAlphaNumeric(array|string $parameters): self
    {
        $this->whereAlphaNumeric = array_merge($this->whereAlphaNumeric, Arr::wrap($parameters));
        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

trait WhereIn
{
    public function getWhereIn(): array
    {
        return $this->whereIn;
    }

    public function setWhereIn(array $whereIn): self
    {
        $this->whereIn = $whereIn;
        return $this;
    }
    public function addWhereIn(array|string $parameters, array $values): self
    {
        $this->whereIn[] = [
            $parameters,
            $values,
        ];
        return $this;
    }
}
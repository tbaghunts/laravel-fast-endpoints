<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

trait Where
{
    public function getWhere(): array
    {
        return $this->where;
    }

    public function setWhere(array $where): self
    {
        $this->where = $where;
        return $this;
    }
    public function addWhere(array|string $name, ?string $expression = null): self
    {
        if (is_array($name)) {
            $this->where = array_merge($this->where, $name);
        } else {
            $this->where[$name] = $expression;
        }

        return $this;
    }
}
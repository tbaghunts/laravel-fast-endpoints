<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

trait Group
{
    public function getGroups(): array
    {
        return $this->groups;
    }

    public function setGroups(array|string $group): self
    {
        $this->groups = array_merge($this->groups, Arr::wrap($group));
        return $this;
    }
}
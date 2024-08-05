<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait WithTrashed
{
    public function getWithTrashed(): bool
    {
        return $this->withTrashed;
    }

    public function withTrashed(): self
    {
        $this->withTrashed = true;
        return $this;
    }

}
<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait Fallback
{
    public function getFallback(): bool
    {
        return $this->fallback;
    }

    public function withFallback(): self
    {
        $this->fallback = true;
        return $this;
    }

    public function withoutFallback(): self
    {
        $this->fallback = false;
        return $this;
    }
}
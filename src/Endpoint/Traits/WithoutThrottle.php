<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait WithoutThrottle
{
    public function setWithoutThrottle(string $name): self
    {
        $this->withoutMiddleware[] = $name;
        return $this;
    }
}
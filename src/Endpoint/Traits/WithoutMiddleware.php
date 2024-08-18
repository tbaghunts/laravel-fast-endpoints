<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

trait WithoutMiddleware
{
    public function getWithoutMiddleware(): array
    {
        return $this->withoutMiddleware;
    }
    public function setWithoutMiddleware(string|array $middleware): self
    {
        $this->withoutMiddleware = array_merge($this->withoutMiddleware, Arr::wrap($middleware));
        return $this;
    }
}
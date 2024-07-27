<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait EndpointConfigMiddleware
{
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    public function setMiddleware(array|string $middleware): self
    {
        $this->middleware = collect($middleware)->toArray();

        return $this;
    }
    public function addMiddleware(array|string $middleware): self
    {
        $this->middleware = array_merge($this->middleware, collect($middleware)->toArray());

        return $this;
    }
}
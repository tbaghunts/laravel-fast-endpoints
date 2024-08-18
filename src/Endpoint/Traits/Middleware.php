<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

trait Middleware
{
    public function getMiddleware(): array
    {
        return $this->middleware;
    }

    public function setMiddleware(array|string $middleware): self
    {
        $this->middleware = Arr::wrap($middleware);

        return $this;
    }
    public function addMiddleware(array|string $middleware): self
    {
        $this->middleware = array_merge($this->middleware, Arr::wrap($middleware));

        return $this;
    }
}
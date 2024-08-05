<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface MiddlewareContract
{
    public function getMiddleware(): array;
    public function setMiddleware(array|string $middleware): self;
    public function addMiddleware(array|string $middleware): self;
}
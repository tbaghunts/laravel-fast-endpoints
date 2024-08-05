<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WithoutMiddlewareContract
{
    public function getWithoutMiddleware();
    public function setWithoutMiddleware(array|string $middleware);
}
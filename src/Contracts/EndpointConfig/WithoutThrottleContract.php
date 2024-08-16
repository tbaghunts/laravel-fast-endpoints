<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WithoutThrottleContract
{
    public function setWithoutThrottle(string $name): self;
}
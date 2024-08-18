<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface WithoutThrottleContract
{
    public function setWithoutThrottle(string $name): self;
}
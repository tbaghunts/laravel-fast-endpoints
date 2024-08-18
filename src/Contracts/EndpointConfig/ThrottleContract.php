<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface ThrottleContract
{
    public function getThrottles(): array;
    public function setThrottle(int $requests, int $perMinute): self;
}
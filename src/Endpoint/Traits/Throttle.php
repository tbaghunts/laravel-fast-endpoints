<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

trait Throttle
{
    public function getThrottles(): array
    {
        return $this->throttles;
    }

    public function setThrottle(int $requests, int $perMinute): self
    {
        $this->throttles[] = [
            "requests" => $requests,
            "perMinute" => $perMinute
        ];
        return $this;
    }
}
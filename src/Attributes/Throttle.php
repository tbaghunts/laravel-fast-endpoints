<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\ThrottleContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Throttle extends EndpointAttribute
{
    public function __construct(
        private readonly int $requests = 60,
        private readonly int $perMinute = 1,
    )
    {
    }

    public function apply(ThrottleContract $endpointConfig): self
    {
        $endpointConfig->setThrottle(
            $this->requests,
            $this->perMinute
        );
        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
class WithoutThrottle extends EndpointAttribute
{
    public function __construct(
        private readonly int|string $requests = 'throttle:60,1',
        private readonly int $perMinute = 1
    )
    {
    }

    public function apply(EndpointConfigContract $endpointConfig): self
    {
        $endpointConfig->setWithoutThrottle($this->getName());
        return $this;
    }

    private function getName(): string
    {
        if (is_string($this->requests)) {
            return $this->requests;
        }

        return sprintf(
            'throttle:%d,%d',
            $this->requests,
            $this->perMinute
        );
    }
}
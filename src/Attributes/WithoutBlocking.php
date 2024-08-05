<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

#[Attribute(Attribute::TARGET_CLASS)]
class WithoutBlocking extends EndpointAttribute
{
    public function apply(EndpointConfigContract $endpointConfig): self
    {
        $endpointConfig->setWithoutBlocking(true);
        return $this;
    }
}
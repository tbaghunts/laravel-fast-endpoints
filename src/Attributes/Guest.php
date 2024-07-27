<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigMiddlewareContract;

#[Attribute(Attribute::TARGET_CLASS)]
class Guest extends EndpointAttribute
{
    public function apply(EndpointConfigMiddlewareContract $endpointConfig): self
    {
        $endpointConfig->addMiddleware("guest");
        return $this;
    }
}
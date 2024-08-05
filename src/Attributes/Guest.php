<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\MiddlewareContract;

#[Attribute(Attribute::TARGET_CLASS)]
class Guest extends EndpointAttribute
{
    public function apply(MiddlewareContract $endpointConfig): self
    {
        $endpointConfig->addMiddleware("guest");
        return $this;
    }
}
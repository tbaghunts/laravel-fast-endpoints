<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WithoutMiddlewareContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
class WithoutMiddleware extends EndpointAttribute
{
    public function __construct(
        private readonly array|string $middleware
    )
    {
    }

    public function apply(WithoutMiddlewareContract $endpointConfig): self
    {
        $endpointConfig->setWithoutMiddleware($this->middleware);
        return $this;
    }
}
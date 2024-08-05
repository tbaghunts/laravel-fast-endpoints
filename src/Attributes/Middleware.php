<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\MiddlewareContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Middleware extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $middleware,
    )
    {
    }

    public function apply(MiddlewareContract $endpointConfig): self
    {
        $endpointConfig->addMiddleware($this->middleware);
        return $this;
    }
}
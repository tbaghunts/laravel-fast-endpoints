<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\MethodContract;

abstract class Method extends EndpointAttribute
{
    protected EnumEndpointMethod $method;

    public function __construct(
        protected string $path
    )
    {
    }

    public function apply(MethodContract $endpointConfig): self
    {
        $endpointConfig->setMethod($this->method);
        $endpointConfig->setPath($this->path);

        return $this;
    }
}
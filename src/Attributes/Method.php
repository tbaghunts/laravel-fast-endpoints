<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\MethodContract;

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
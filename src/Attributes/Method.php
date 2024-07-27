<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigMethodContract;

abstract class Method extends EndpointAttribute
{
    protected EnumEndpointMethod $method;

    public function __construct(
        protected string $path
    )
    {
    }

    public function apply(EndpointConfigMethodContract $endpointConfig): self
    {
        $endpointConfig->setMethod($this->method);
        $endpointConfig->setPath($this->path);

        return $this;
    }
}
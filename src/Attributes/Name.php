<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigMethodContract;

#[Attribute(Attribute::TARGET_CLASS)]
class Name extends EndpointAttribute
{
    public function __construct(
        private readonly string $name,
    )
    {
    }

    public function apply(EndpointConfigMethodContract $endpointConfig): self
    {
        $endpointConfig->setName($this->name);
        return $this;
    }
}
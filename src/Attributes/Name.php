<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\MethodContract;

#[Attribute(Attribute::TARGET_CLASS)]
class Name extends EndpointAttribute
{
    public function __construct(
        private readonly string $name,
    )
    {
    }

    public function apply(MethodContract $endpointConfig): self
    {
        $endpointConfig->setName($this->name);
        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\MethodContract;

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
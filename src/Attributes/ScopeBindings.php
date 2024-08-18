<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\ScopeBindingsContract;

#[Attribute(Attribute::TARGET_CLASS)]
class ScopeBindings extends EndpointAttribute
{
    public function __construct(
        private readonly bool|null $scopeBindings = true,
    )
    {
    }

    public function apply(ScopeBindingsContract $endpointConfig): self
    {
        $endpointConfig->setScopeBindings($this->scopeBindings);
        return $this;
    }
}
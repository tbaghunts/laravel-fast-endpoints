<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigScopeBindingsContract;

#[Attribute(Attribute::TARGET_CLASS)]
class ScopeBindings extends EndpointAttribute
{
    public function __construct(
        private readonly bool|null $scopeBindings = true,
    )
    {
    }

    public function apply(EndpointConfigScopeBindingsContract $endpointConfig): self
    {
        $endpointConfig->setScopeBindings($this->scopeBindings);
        return $this;
    }
}
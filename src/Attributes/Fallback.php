<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\FallbackContract;

#[Attribute(Attribute::TARGET_CLASS)]
class Fallback extends EndpointAttribute
{
    public function apply(FallbackContract $endpointConfig): self
    {
        $endpointConfig->withFallback();
        return $this;
    }
}
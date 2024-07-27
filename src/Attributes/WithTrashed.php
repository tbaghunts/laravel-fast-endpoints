<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigWithTrashedContract;

#[Attribute(Attribute::TARGET_CLASS)]
class WithTrashed extends EndpointAttribute
{
    public function apply(EndpointConfigWithTrashedContract $endpointConfig): self
    {
        $endpointConfig->withTrashed();
        return $this;
    }
}
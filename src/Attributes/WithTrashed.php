<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WithTrashedContract;

#[Attribute(Attribute::TARGET_CLASS)]
class WithTrashed extends EndpointAttribute
{
    public function apply(WithTrashedContract $endpointConfig): self
    {
        $endpointConfig->withTrashed();
        return $this;
    }
}
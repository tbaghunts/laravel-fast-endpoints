<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointAttributeContract;

abstract class EndpointAttribute implements EndpointAttributeContract
{
    abstract public function apply(EndpointConfigContract $endpointConfig): self;
}
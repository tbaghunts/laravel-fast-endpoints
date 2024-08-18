<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointAttributeContract;

abstract class EndpointAttribute implements EndpointAttributeContract
{
    abstract public function apply(EndpointConfigContract $endpointConfig): self;
}
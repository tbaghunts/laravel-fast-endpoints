<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

#[Attribute(Attribute::TARGET_CLASS)]
final class Put extends Method
{
    public EnumEndpointMethod $method = EnumEndpointMethod::PUT;
}
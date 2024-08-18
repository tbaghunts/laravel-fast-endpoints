<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

#[Attribute(Attribute::TARGET_CLASS)]
final class Patch extends Method
{
    public EnumEndpointMethod $method = EnumEndpointMethod::PATCH;
}
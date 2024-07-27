<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

#[Attribute(Attribute::TARGET_CLASS)]
final class Patch extends Method
{
    public EnumEndpointMethod $method = EnumEndpointMethod::PATCH;
}
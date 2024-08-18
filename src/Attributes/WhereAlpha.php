<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WhereAlphaContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereAlpha extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters
    )
    {
    }

    public function apply(WhereAlphaContract $endpointConfig): self
    {
        $endpointConfig->addWhereAlpha($this->parameters);
        return $this;
    }
}
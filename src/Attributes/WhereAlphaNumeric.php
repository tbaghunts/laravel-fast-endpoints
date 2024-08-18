<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WhereAlphaNumericContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereAlphaNumeric extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters
    )
    {
    }

    public function apply(WhereAlphaNumericContract $endpointConfig): self
    {
        $endpointConfig->addWhereAlphaNumeric($this->parameters);
        return $this;
    }
}
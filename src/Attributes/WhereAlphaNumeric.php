<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigWhereAlphaNumericContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereAlphaNumeric extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters
    )
    {
    }

    public function apply(EndpointConfigWhereAlphaNumericContract $endpointConfig): self
    {
        $endpointConfig->addWhereAlphaNumeric($this->parameters);
        return $this;
    }
}
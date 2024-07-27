<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigWhereNumberContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereNumber extends EndpointAttribute
{
    public function __construct(
        private readonly array|string $parameters
    )
    {
    }

    public function apply(EndpointConfigWhereNumberContract $endpointConfig): self
    {
        $endpointConfig->addWhereNumber($this->parameters);
        return $this;
    }
}
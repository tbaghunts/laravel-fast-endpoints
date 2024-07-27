<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigWhereUlidContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereUlid extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters
    )
    {
    }

    public function apply(EndpointConfigWhereUlidContract $endpointConfig): self
    {
        $endpointConfig->addWhereUlid($this->parameters);
        return $this;
    }
}
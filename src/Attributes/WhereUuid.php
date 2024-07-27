<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\EndpointConfigWhereUuidContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereUuid extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters
    )
    {
    }

    public function apply(EndpointConfigWhereUuidContract $endpointConfig): self
    {
        $endpointConfig->addWhereUuid($this->parameters);
        return $this;
    }
}
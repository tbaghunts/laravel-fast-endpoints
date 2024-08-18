<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WhereUlidContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereUlid extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters
    )
    {
    }

    public function apply(WhereUlidContract $endpointConfig): self
    {
        $endpointConfig->addWhereUlid($this->parameters);
        return $this;
    }
}
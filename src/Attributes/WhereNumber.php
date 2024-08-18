<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WhereNumberContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereNumber extends EndpointAttribute
{
    public function __construct(
        private readonly array|string $parameters
    )
    {
    }

    public function apply(WhereNumberContract $endpointConfig): self
    {
        $endpointConfig->addWhereNumber($this->parameters);
        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WhereInContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class WhereIn extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $parameters,
        private readonly array $values,
    )
    {
    }

    public function apply(WhereInContract $endpointConfig): self
    {
        $endpointConfig->addWhereIn($this->parameters, $this->values);
        return $this;
    }
}
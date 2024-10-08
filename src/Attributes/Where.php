<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\WhereContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Where extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $name,
        private readonly ?string $expression = null,
    )
    {
    }

    public function apply(WhereContract $endpointConfig): self
    {
        $endpointConfig->addWhere($this->name, $this->expression);
        return $this;
    }
}
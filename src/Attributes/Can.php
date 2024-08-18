<?php

namespace Baghunts\LaravelFastEndpoints\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\CanContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Can extends EndpointAttribute
{
    public function __construct(
        private readonly array|string $ability,
        private readonly array|string|null $models = null,
    )
    {
    }

    public function apply(CanContract $endpointConfig): self
    {
        $endpointConfig->setCan($this->ability, $this->models);
        return $this;
    }
}
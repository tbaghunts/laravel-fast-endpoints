<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\CanContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
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
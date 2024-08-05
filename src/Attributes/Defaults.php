<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Defaults extends EndpointAttribute
{
    public function __construct(
        private readonly string|array $key,
        private readonly mixed $value,
    )
    {
    }

    public function apply(EndpointConfigContract $endpointConfig): self
    {
        if (is_array($this->key)) {
            $endpointConfig->setDefaults($this->key);
        } else {
            $endpointConfig->addDefault($this->key, $this->value);
        }

        return $this;
    }
}
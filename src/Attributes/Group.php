<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\GroupContract;

#[Attribute(Attribute::TARGET_CLASS | Attribute::IS_REPEATABLE)]
class Group extends EndpointAttribute
{
    public function __construct(
        private readonly array|string $groups,
    )
    {
    }

    public function apply(GroupContract $endpointConfig): self
    {
        $endpointConfig->setGroups($this->groups);
        return $this;
    }
}
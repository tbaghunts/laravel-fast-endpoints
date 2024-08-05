<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\BlockContract;

#[Attribute(Attribute::TARGET_CLASS)]
class Block extends EndpointAttribute
{
    public function __construct(
        private readonly ?int $lockSeconds = null,
        private readonly ?int $waitSeconds = null,
    )
    {
    }

    public function apply(BlockContract $endpointConfig): self
    {
        $endpointConfig->setLock($this->lockSeconds);
        $endpointConfig->setWait($this->waitSeconds);

        return $this;
    }
}
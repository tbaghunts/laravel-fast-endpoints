<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait WithoutBlocking
{
    public function getWithoutBlocking(): bool
    {
        return $this->withoutBlock;
    }

    public function setWithoutBlocking(bool $withoutBlock): self
    {
        $this->withoutBlock = $withoutBlock;
        return $this;
    }
}
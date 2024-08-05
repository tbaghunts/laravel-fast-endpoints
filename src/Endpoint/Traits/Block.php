<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait Block
{
    public function getBlock(): array
    {
        return $this->block;
    }

    public function setLock(int|null $block): self
    {
        $this->block[0] = $block;
        return $this;
    }

    public function setWait(int|null $block): self
    {
        $this->block[1] = $block;
        return $this;
    }
}
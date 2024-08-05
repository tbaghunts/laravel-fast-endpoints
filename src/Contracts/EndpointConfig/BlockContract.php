<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface BlockContract
{
    public function getBlock(): array;
    public function setLock(?int $lockSeconds): self;
    public function setWait(?int $waitSeconds): self;
}
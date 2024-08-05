<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WithoutBlockingContract
{
    public function getWithoutBlocking(): bool;
    public function setWithoutBlocking(bool $value): self;
}
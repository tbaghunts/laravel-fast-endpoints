<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface CanContract
{
    public function getCan(): array;
    public function setCan(array|string $ability, array|string|null $models = null): self;
}
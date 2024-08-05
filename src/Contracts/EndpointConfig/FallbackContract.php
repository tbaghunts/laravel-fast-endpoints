<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface FallbackContract
{
    public function getFallback(): bool;
    public function withFallback(): self;
    public function withoutFallback(): self;
}
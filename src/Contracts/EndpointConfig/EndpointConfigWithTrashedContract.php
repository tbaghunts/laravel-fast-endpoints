<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigWithTrashedContract
{
    public function withTrashed(): self;
    public function withoutTrashed(): self;
    public function getWithTrashed(): bool|null;
}
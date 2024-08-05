<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WithTrashedContract
{
    public function withTrashed(): self;
    public function getWithTrashed(): bool;
}
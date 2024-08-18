<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface WithTrashedContract
{
    public function withTrashed(): self;
    public function getWithTrashed(): bool;
}
<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface EndpointConfigMergeContract
{
    public function merge(array $config): self;
    public function mergeCollection(array $configs): self;
}
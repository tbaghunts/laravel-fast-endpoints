<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigMergeContract
{
    public function merge(array $config): self;
    public function mergeCollection(array $configs): self;
}
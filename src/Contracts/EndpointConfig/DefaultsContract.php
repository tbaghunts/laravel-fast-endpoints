<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface DefaultsContract
{
    public function getDefaults(): array;
    public function setDefaults(array $defaults): self;
    public function addDefault(string $key, mixed $value): self;
}

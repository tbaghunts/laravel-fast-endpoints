<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

interface MethodContract
{
    public function getPath(): ?string;
    public function getName(): ?string;
    public function getMethod(): array;

    public function setPath(string $path): self;
    public function setName(string $name): self;
    public function setMethod(array|EnumEndpointMethod $method): self;
}
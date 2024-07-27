<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

interface EndpointConfigMethodContract
{
    public function getPath(): ?string;
    public function getName(): ?string;
    public function getMethod(): array;

    public function setPath(string $path): self;
    public function setName(?string $name): self;
    public function setMethod(array|EnumEndpointMethod $method): self;
}
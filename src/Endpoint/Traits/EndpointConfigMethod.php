<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

trait EndpointConfigMethod
{
    public function getPath(): ?string
    {
        return $this->path;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function getMethod(): array
    {
        return $this->method;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;
        return $this;
    }
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function setMethod(array|EnumEndpointMethod $method): self
    {
        if (!is_array($method)) {
            $method = [$method];
        }

        $this->method = array_merge($this->method, $method);
        return $this;
    }
}
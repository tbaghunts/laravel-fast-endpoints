<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

use Illuminate\Support\Arr;

use Baghunts\LaravelFastEndpoints\Enums\EnumEndpointMethod;

trait Method
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
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }
    public function setMethod(array|EnumEndpointMethod $method): self
    {
        $this->method = array_merge($this->method, Arr::wrap($method));
        return $this;
    }
}
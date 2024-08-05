<?php

namespace Baghunts\LaravelFastEndpoint\Attributes;

use Attribute;

use Illuminate\Support\Arr;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\MethodContract;

#[Attribute(Attribute::TARGET_CLASS)]
final class Route extends EndpointAttribute
{
    private array $methods;

    public function __construct(
        private readonly string $path,
        ...$args,
    )
    {
        $this->methods = Arr::flatten($args);
    }

    public function apply(MethodContract $endpointConfig): self
    {
        $endpointConfig->setPath($this->path);
        $endpointConfig->setMethod($this->methods);

        return $this;
    }
}

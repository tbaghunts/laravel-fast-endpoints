<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGeneratorContract;

interface EndpointClassGeneratorContract extends ClassGeneratorContract
{
    public function getOptions(): array;
    public function getAttributes(): array;
    public function getRoutePath(): ?string;
    public function setRoutePath(string $path): self;
    public function loadOptions(array $options): self;
    public function getOption(string $name, $default = null): mixed;
    public function setAttribute(string $name, array|string|null $args = null): self;
}
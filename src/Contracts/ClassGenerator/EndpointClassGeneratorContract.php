<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\ClassGenerator;

use Baghunts\LaravelFastEndpoints\Contracts\ClassGeneratorContract;

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
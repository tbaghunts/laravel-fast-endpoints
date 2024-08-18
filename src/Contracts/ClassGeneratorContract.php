<?php

namespace Baghunts\LaravelFastEndpoints\Contracts;

interface ClassGeneratorContract
{
    public function generate(): self;
    public function getDist(): string;
    public function getSource(): string;
    public function getImports(): array;

    public function getClassName(): string;
    public function getNamespace(): string;
    public function getFileNamespace(): string;
    public function getBaseClassName(): ?string;
    public function setImport(string $namespace, array|string|null $entity = null): self;
}
<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

interface RouterGeneratorContract
{
    public function getRoutesSource(): string;
    public function getRoutesGeneratedFileMeta(): array;
}
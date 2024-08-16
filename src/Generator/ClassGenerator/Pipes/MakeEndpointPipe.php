<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;
use Str;

abstract class MakeEndpointPipe
{
    abstract function handle(EndpointClassGeneratorContract $generator, Closure $next): void;

    public function parseOptionValueToStringArgs(?string $value): string
    {
        if (!$value) {
            return '';
        }

        return Str::of($value)
            ->explode(',')
            ->map(fn($part) => sprintf("'%s'", trim($part)))
            ->join(',');
    }
}
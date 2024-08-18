<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;
use Str;

class CanPipe extends MakeEndpointPipe
{
    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $can = $generator->getOption('can');
        if (!$can) {
            return;
        }

        $canArgs = Str::of($can)
            ->explode(',')
            ->map(fn(string $val) => sprintf("'%s'", trim($val)));

        if ($canArgs->isNotEmpty()) {
            $generator->setAttribute('Can', $canArgs->toArray());
        }

        $next($generator);
    }
}
<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;

class NamePipe extends MakeEndpointPipe
{
    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $name = $generator->getOption('name');
        if (!empty($name)) {
            $generator->setAttribute('Name', "'{$name}'");
        }

        $next($generator);
    }
}
<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;

class ScopeBindingsPipe extends MakeEndpointPipe
{
    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        if ($generator->getOption('scope-bindings')) {
            $generator->setAttribute('ScopeBindings');
        }

        $next($generator);
    }
}
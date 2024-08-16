<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Closure;

use Illuminate\Support\Str;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;

class DefaultsPipe extends MakeEndpointPipe
{
    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $defaults = $generator->getOption('defaults');
        if (!empty($defaults)) {
            $generator->setAttribute(
                'Defaults',
                $this->parseOptionValueToStringArgs($defaults)
            );
        }

        $next($generator);
    }
}
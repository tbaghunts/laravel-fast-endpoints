<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;

class ThrottlePipe extends MakeEndpointPipe
{
    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $throttle = $generator->getOption('throttle');
        if (!empty($throttle)) {
            $generator->setAttribute('Throttle', $throttle);
        }

        $next($generator);
    }
}
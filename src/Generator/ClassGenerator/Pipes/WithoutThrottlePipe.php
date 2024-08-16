<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;

class WithoutThrottlePipe extends MakeEndpointPipe
{
    public function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $withoutThrottle = $generator->getOption('without-throttle');
        if (!empty($withoutThrottle)) {
            $generator->setAttribute(
                'WithoutThrottle',
                $withoutThrottle
            );
        }

        $next($generator);
    }
}
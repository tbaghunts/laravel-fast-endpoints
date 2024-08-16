<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;
use Str;

class MiddlewarePipe extends MakeEndpointPipe
{
    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $middlewareOption = $generator->getOption('middleware', '');

        $middleware = Str::of($middlewareOption)
            ->explode(',')
            ->map(function(string $middleware) {
                return sprintf(
                    "'%s'",
                    trim($middleware)
                );
            })->toArray();

        if (!empty($middleware)) {
            $generator
                ->setAttribute('Middleware', $middleware);
        }

        $next($generator);
    }
}
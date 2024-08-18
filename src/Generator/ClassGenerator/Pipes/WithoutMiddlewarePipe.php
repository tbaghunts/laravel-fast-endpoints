<?php

namespace Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Closure;
use Illuminate\Support\Str;

class WithoutMiddlewarePipe extends MakeEndpointPipe
{
    public function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $withoutMiddleware = $generator->getOption('without-middleware');
        if (!empty($withoutMiddleware)) {
            $withoutMiddleware = Str::of($withoutMiddleware)
                ->explode(',')
                ->map(function (string $value) {
                    return sprintf(
                        "'%s'",
                        trim($value)
                    );
                })->join(', ');

            $generator->setAttribute(
                'WithoutMiddleware',
                $withoutMiddleware
            );
        }

        $next($generator);
    }
}
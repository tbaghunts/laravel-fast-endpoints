<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class WithTrashedPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $withTrashed = $generator->getEndpointConfiguration()->getWithTrashed();

        if (is_bool($withTrashed)) {
            $generator->addStatement(
                sprintf(
                    "%s()",
                    $withTrashed ? 'withTrashed' : 'withoutTrashed'
                )
            );
        }

        $next($generator);
    }
}
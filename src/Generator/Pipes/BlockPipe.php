<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

class BlockPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $block = $generator->getEndpointConfiguration()->getBlock();
        if (!empty($block)) {
            $generator->getRoute()->block(...$block);
        }

        $next($generator);
    }
}
<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

abstract class RoutePipe
{
    public abstract function handle(RouteGeneratorContract $generator, Closure $next): void;
}
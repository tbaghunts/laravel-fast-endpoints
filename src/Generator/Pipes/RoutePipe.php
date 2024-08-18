<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

abstract class RoutePipe
{
    public abstract function handle(RouteGeneratorContract $generator, Closure $next): void;
}
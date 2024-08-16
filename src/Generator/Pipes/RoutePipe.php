<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Closure;

abstract class RoutePipe
{
    public abstract function handle(RouteGeneratorContract $generator, Closure $next): void;
}
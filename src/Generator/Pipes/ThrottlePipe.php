<?php

namespace Baghunts\LaravelFastEndpoints\Generator\Pipes;

use Baghunts\LaravelFastEndpoints\Contracts\RouteGeneratorContract;
use Closure;

class ThrottlePipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $throttles = $generator->getEndpointConfiguration()->getThrottles();
        if (!empty($throttles)) {
            $middlewares = array_map(function (array $throttle) {
                return sprintf(
                    'throttle:%s,%s',
                    $throttle['requests'],
                    $throttle['perMinute'],
                );
            }, $throttles);

            if (!empty($middlewares)) {
                $generator->getRoute()->middleware($middlewares);
            }
        }

        $next($generator);
    }
}
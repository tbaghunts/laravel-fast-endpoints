<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;

abstract class RouteWherePipe extends RoutePipe
{
    protected abstract function getRouteMethodKey(): string;
    protected abstract function getRouteConfigProperty(): string;

    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $values = $this->getRouteProperty($generator);
        if (!empty($values)) {
            foreach ($values as $value) {
                $generator->addStateMent(
                    sprintf(
                        "%s('%s')",
                        $this->getRouteMethodKey(), $value
                    )
                );
            }
        }

        $next($generator);
    }

    protected function getRouteProperty(RouteGeneratorContract $generator): array
    {
        $configProperty = $this->getRouteConfigProperty();
        $endpointConfig = $generator->getEndpointConfiguration();

        if (!method_exists($endpointConfig, $configProperty)) {
            return [];
        }

        return $endpointConfig->{$configProperty}();
    }
}
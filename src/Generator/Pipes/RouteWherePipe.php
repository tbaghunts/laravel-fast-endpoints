<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Closure;

abstract class RouteWherePipe extends RoutePipe
{
    protected abstract function getRouteMethodKey(): string;
    protected abstract function getRouteConfigProperty(): string;

    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $method = $this->getRouteMethodKey();
        $values = $this->getRouteProperty($generator);

        if (!empty($values)) {
            $router = $generator->getRoute();
            foreach ($values as $value) {
                $router->{$method}($value);
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
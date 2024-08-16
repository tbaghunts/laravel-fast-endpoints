<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes;

use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\EndpointClassGeneratorContract;
use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Closure;

class MethodPipe extends MakeEndpointPipe
{
    const array METHODS = [
        'any',
        'get',
        'put',
        'head',
        'post',
        'patch',
        'delete',
        'options',
    ];

    private EndpointClassGeneratorContract $generator;

    function handle(EndpointClassGeneratorContract $generator, Closure $next): void
    {
        $this->generator = $generator;

        $this->make();

        $next($this->generator);
    }

    private function make(): void
    {
        $methods = $this->getSelectedMethods($this->generator->getOptions());

        if (count($methods) === 1) {
            [$attr] = $methods;

            $this->generator
                ->setAttribute($attr, "'{$this->generator->getRoutePath()}'");
        } else {
            $this->generator
                ->setAttribute('Route', [
                    "'{$this->generator->getRoutePath()}'",
                    ...$this->makeRouteAttributeStatement($methods),
                ])
                ->setImport(EnumEndpointMethod::class)
            ;
        }
    }

    private function getSelectedMethods(array $options): array
    {
        $data = [];
        foreach (self::METHODS as $method) {
            if (!($options[$method] ?? null)) {
                continue;
            }

            if ($method === 'any') {
                return ['Any'];
            }

            $data[] = ucfirst($method);
        }

        return empty($data) ? ['Any'] : $data;
    }

    private function makeRouteAttributeStatement(array $methods): array
    {
        return collect($methods)->map(function (string $method) {
            return sprintf(
                '%s::%s',
                'EnumEndpointMethod',
                strtoupper($method)
            );
        })->toArray();
    }
}
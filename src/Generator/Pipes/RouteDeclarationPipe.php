<?php

namespace Baghunts\LaravelFastEndpoint\Generator\Pipes;

use Closure;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Contracts\RouteGeneratorContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

class RouteDeclarationPipe extends RoutePipe
{
    public function handle(RouteGeneratorContract $generator, Closure $next): void
    {
        $declarationStatement = $this->getDeclarationStatement($generator);
        $generator->addStatement($declarationStatement);

        $next($generator);
    }

    protected function getDeclarationStatement(RouteGeneratorContract $generator): string
    {
        $endpointConfig = $generator->getEndpointConfiguration();
        $methods = $endpointConfig->getMethod();

        if (empty($methods)) {
            return $this->getDeclarationStatementWithoutMethods($generator);
        }

        return $this->getDeclarationStatementWithMethods($generator);
    }
    protected function getDeclarationStatementWithoutMethods(RouteGeneratorContract $generator): string
    {
        $endpointConfig = $generator->getEndpointConfiguration();

        return sprintf(
            "# Route without methods (name: %s, path: %s)",
            $endpointConfig->getName() ?? "null",
            $endpointConfig->getPath() ?? "null"
        );
    }
    protected function getDeclarationStatementWithMethods(RouteGeneratorContract $generator): string
    {
        $endpointConfig = $generator->getEndpointConfiguration();
        $methodDeclaration = $this->getMethodStatement($endpointConfig);

        return sprintf(
            "Route::%s'%s',%s::class)",
            $methodDeclaration,
            $endpointConfig->getPath(),
            $generator->getEndpointClassNamespace()
        );
    }
    protected function getMethodStatement(EndpointConfigContract $endpointConfigContract): string
    {
        $methods = $endpointConfigContract->getMethod();

        if (count($methods) === 1) {
            return sprintf("%s(", $methods[0]->value);
        }

        $methods = array_map(fn(EnumEndpointMethod $method) => "'{$method->value}'", $methods);

        return sprintf("match([%s],", implode(",", $methods));
    }
}
<?php

namespace Baghunts\LaravelFastEndpoint\Generator;

use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Pipeline;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;
use Baghunts\LaravelFastEndpoint\Contracts\{
    RouteGeneratorContract,
    EndpointConfigContract,
};
use Baghunts\LaravelFastEndpoint\Generator\Pipes\{
    CanPipe,
    BlockPipe,
    GroupPipe,
    WherePipe,
    WhereInPipe,
    DefaultsPipe,
    RouteNamePipe,
    WhereUuidPipe,
    WhereUlidPipe,
    WhereAlphaPipe,
    MiddlewarePipe,
    WithTrashedPipe,
    WhereNumberPipe,
    ScopeBindingsPipe,
    WithoutBlockingPipe,
    WithoutMiddlewarePipe,
    WhereAlphaNumericPipe
};

class RouteGenerator implements RouteGeneratorContract
{
    private ?Route $route = null;

    public function __construct(
        private readonly Router                 $router,
        private readonly string                 $classNamespace,
        private readonly EndpointConfigContract $endpointConfig,
    )
    {
        $this->initRoute();
    }

    private function initRoute(): void
    {
        $methods = $this->getMethods();
        $path = $this->endpointConfig->getPath();

        $isNotProcessableRoute = empty($methods) || empty($path);

        if ($isNotProcessableRoute) {
            return;
        }

        $this->route = $this->createRoute($methods, $path);
    }
    private function getMethods(): array|string
    {
        $data = [];

        foreach ($this->endpointConfig->getMethod() as $method) {
            if ($method === EnumEndpointMethod::ANY) {
                return "any";
            }

            $data[] = $method->value;
        }

        return $data;
    }
    private function createRoute(array|string $methods, string $path): Route
    {
        return match ($methods) {
            "any" => $this->router->any($path, $this->classNamespace),
            default => $this->router->addRoute($methods, $path, $this->classNamespace),
        };
    }

    public function getRoute(): ?Route
    {
        return $this->route;
    }
    public function getEndpointConfiguration(): EndpointConfigContract
    {
        return $this->endpointConfig;
    }

    public function generate(): ?Route
    {
        if (!$this->getRoute()) {
            return null;
        }

        return $this
            ->margeNamespaceConfig()
            ->execPipes();
    }

    protected function margeNamespaceConfig(): self
    {
        $namespaceScopedConfigs = $this->detectNamespaceScopeConfig();
        if (!is_null($namespaceScopedConfigs)) {
            $this->endpointConfig->mergeCollection(
                $namespaceScopedConfigs
            );
        }

        return $this;
    }

    protected function detectNamespaceScopeConfig(): ?array
    {
        $namespaces = config("fast-endpoints.namespaces");

        if (empty($namespaces)) {
            return null;
        }

        $strOf = Str::of($this->classNamespace);

        return collect($namespaces)
            ->filter(fn(array $config, string $namespace) => $strOf->contains($namespace))
            ->values()
            ->toArray();
    }

    protected function execPipes(): ?Route
    {
        return Pipeline::send($this)
            ->through([
                // Should be first for default configs and groups configs merge,
                // before a main pipeline execution
                GroupPipe::class,

                DefaultsPipe::class,
                RouteNamePipe::class,

                CanPipe::class,
                BlockPipe::class,
                MiddlewarePipe::class,
                WithoutBlockingPipe::class,
                WithoutMiddlewarePipe::class,

                WithTrashedPipe::class,
                ScopeBindingsPipe::class,

                WherePipe::class,
                WhereInPipe::class,
                WhereUuidPipe::class,
                WhereUlidPipe::class,
                WhereAlphaPipe::class,
                WhereNumberPipe::class,
                WhereAlphaNumericPipe::class,
            ])->thenReturn();
    }
}
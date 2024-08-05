<?php

namespace Baghunts\LaravelFastEndpoint\Generator;

use Illuminate\Routing\Router;

use Baghunts\LaravelFastEndpoint\Contracts\{
    ScannerContract,
    RouteGeneratorContract,
    RouterGeneratorContract
};

readonly class RouterGenerator implements RouterGeneratorContract
{
    public function __construct(
        private Router $router,
        private ScannerContract $scanner,
    )
    {
    }

    public function generate(): void
    {
        $endpoints = $this->scanner->findEndpoints();

        if (empty($endpoints)) {
            return;
        }

        $this->registerRouterGroup($endpoints);
    }

    private function registerRouterGroup(array $endpoints): void
    {
        $fastEndpoints = config('fast-endpoints');

        $this->router->group(
            [
                "domain" => $fastEndpoints["domain"],
                "prefix" => $fastEndpoints["prefix"],
                "middleware" => $fastEndpoints["middleware"],
            ],
            function () use ($endpoints) {
                $this->generateRoutes($endpoints);
            }
        );
    }
    private function generateRoutes(array $endpoints): void
    {
        foreach ($endpoints as $name => $config) {
            app(RouteGeneratorContract::class, [
                'router' => $this->router,
                'classNamespace' => $name,
                'endpointConfig' => $config,
            ])->generate();
        }
    }
}
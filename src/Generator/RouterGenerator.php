<?php

namespace Baghunts\LaravelFastEndpoint\Generator;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

use Baghunts\LaravelFastEndpoint\Contracts\{
    ScannerContract,
    EndpointConfigContract,
    RouteGeneratorContract,
    RouterGeneratorContract
};

readonly class RouterGenerator implements RouterGeneratorContract
{
    public function __construct(
        private ScannerContract $scanner
    )
    {
    }

    public function getRoutesSource(): string
    {
        $cache = $this->getFromCache();
        return !empty($cache) ? $cache : $this->generateRoutesOutput();
    }
    public function getRoutesGeneratedFileMeta(): array
    {
        return $this->makeTmpFile($this->getRoutesSource());
    }

    protected function generateRoutesOutput(): string
    {
        $generatedRoutes = $this->generateRoutes();

        return sprintf(
            <<<PHP
            <?php
            use Illuminate\Support\Facades\Route;
            
            Route::prefix('%s')->group(function() {
            %s
            });
            PHP,
            config("fast-endpoints.prefix"),
            $generatedRoutes->join(PHP_EOL)
        );
    }
    protected function generateRoutes(): Collection
    {
        $routes = $this->scanner->findEndpoints()->map(function (EndpointConfigContract $config, string $name) {
            return app(RouteGeneratorContract::class, [
                'classNamespace' => $name,
                'endpointConfig' => $config,
            ])->output();
        });

        return collect($routes);
    }

    protected function makeTmpFile(string $output): array
    {
        $file = tmpfile();
        fwrite($file, $output);
        $path = stream_get_meta_data($file)['uri'];

        return [$path, $file];
    }

    protected function getFromCache(): ?string
    {
        $cache = Cache::get(config("fast-endpoints.cache_key"));
        return empty($cache) ? null : (string)$cache;
    }
}
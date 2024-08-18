<?php

namespace Baghunts\LaravelFastEndpoints\Commands;

use Baghunts\LaravelFastEndpoints\Contracts\ClassGeneratorContract;
use Str;
use Storage;

use Illuminate\Console\Command;
use Illuminate\Support\Stringable;

use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Baghunts\LaravelFastEndpoints\Generator\ClassGenerator\{
    EndpointClassGenerator,
    EndpointResponseClassGenerator,
    EndpointRequestClassGeneratorContract,
};

class MakeEndpointCommand extends Command
{
    const array METHOD_OPTIONS = [
        'any',
        'get',
        'put',
        'head',
        'post',
        'patch',
        'delete',
        'options',
    ];

    private Stringable $dist;

    /**
     * @var Array<string, ClassGeneratorContract>
     */
    private array $partials = [];

    protected $signature = 'make:fast-endpoint
                            {path : The URI path for the endpoint}
                            
                            {--with-request : Generate endpoint request class}
                            {--with-response : Generate endpoint response class}
                            
                            {--name= : The name of the endpoint}
                            {--dist= : The destination path for the endpoint class}
                            {--request= : Specify the request handler class for the endpoint}
                            {--response= : Specify the response handler class for the endpoint}
                            {--defaults= : Specify default values for dynamic segments in the endpoint URI}
                            
                            {--any : Allow any HTTP method for the endpoint}
                            {--get : Allow GET method for the endpoint}
                            {--put : Allow PUT method for the endpoint}
                            {--post : Allow POST method for the endpoint}
                            {--head : Allow HEAD method for the endpoint}
                            {--patch : Allow PATCH method for the endpoint}
                            {--delete : Allow DELETE method for the endpoint}
                            {--options : Allow OPTIONS method for the endpoint}
                            
                            {--can= : Specify authorization can(s) for the endpoint}
                            {--guest : Allow guest access to the endpoint}
                            {--throttle= : Specify throttling rules for the endpoint}
                            {--middleware= : Specify middleware(s) for the endpoint}
                            {--without-throttle= : Exclude specific throttling rules for the endpoint}
                            {--without-middleware= : Exclude specific middleware(s) for the endpoint}
                            
                            {--with-trashed : Include trashed records in the endpoint}
                            {--scope-bindings : Enable scope bindings for the endpoint}
                            
                            
                            {--where-uuid= : Define UUID validation rule for URI segment parameters}
                            {--where-ulid= : Define ULID validation rule for URI segment parameters}
                            {--where-number= : Define numerical validation rule for URI segment parameters}
                            {--where-alpha= : Define alphabetical validation rule for URI segment parameters}
                            {--where-alpha-numeric= : Define alphanumeric validation rule for URI segment parameters}';

    protected $description = 'Generates a Fast Endpoint class, with optional request and response handlers, and various configurations for streamlined API development. Customize the endpoint with specific methods, authorization, middleware, and URI parameter validation.';

    public function handle(): int
    {
        $this->dist = $this->getEndpointFullDist();

        $this
            ->tryGenerateRequest()
            ->tryGenerateResponse()
            ->tryGenerateEndpoint()
            ->saveFiles();

        return 0;
    }

    private function setPartial(string $name, ClassGeneratorContract $generator): void
    {
        $this->partials[$name] = $generator;
    }

    private function getPartial(string $name): ?ClassGeneratorContract
    {
        return $this->partials[$name] ?? null;
    }

    private function tryGenerateRequest(): self
    {
        $request = $this->getRequestNamespace();

        if (!empty($request)) {
            $this->setPartial(
                'request',
                app(EndpointRequestClassGeneratorContract::class, [
                    'base' => $request,
                    'dist' => $this->dist->append('Request'),
                ])->generate()
            );
        }

        return $this;
    }

    private function tryGenerateResponse(): self
    {
        $response =  $this->getResponseNamespace();

        if (!empty($response)) {
            $this->setPartial(
                'response',
                app(EndpointResponseClassGenerator::class, [
                    'base' => $response,
                    'dist' => $this->dist->append('Response'),
                ])
                ->setRequestNamespace($this->getPartial('request')?->getFileNamespace())
                ->generate()
            );
        }

        return $this;
    }

    private function tryGenerateEndpoint(): self
    {
        $this->setPartial(
            'endpoint',
            app(EndpointClassGenerator::class, [
                'dist' => $this->dist,
                'base' => Endpoint::class,
            ])
            ->loadOptions($this->options())
            ->setRoutePath($this->argument('path'))
            ->setRequestNamespace($this->getPartial('request')?->getFileNamespace())
            ->setResponseNamespace($this->getPartial('response')?->getFileNamespace())
            ->generate()
        );

        return $this;
    }

    private function saveFiles(): void
    {
        $storage = Storage::build(base_path());

        $continuedCount = 0;
        foreach ($this->partials as $generator) {
            $dist = $generator->getDist();
            $source = $generator->getSource();

            if (empty($source)) {
                continue;
            }

            if ($storage->exists($dist)) {
                $isRewriteConfirmed = $this->confirm(
                    sprintf(
                        "File is already exists by path %s, Do you want to rewrite it?",
                        $dist
                    ),
                );

                if (!$isRewriteConfirmed) {
                    $continuedCount++;
                    continue;
                }
            }

            $storage->put($dist, $source);
        }

        if (count($this->partials) > $continuedCount) {
            $this->successMessage();
        }
    }

    private function successMessage(): void
    {
        $this->info(
            sprintf(
                'Fast endpoint [%s] generated successfully.',
                $this->getPartial('endpoint')?->getNamespace() ?? ''
            )
        );
    }

    private function getEndpointDist(): string
    {
        $dist = $this->option('dist');
        if (empty($dist)) {
            $dist = $this->generateEndpointDistByPath();
        }

        return $dist;
    }

    private function generateEndpointDistByPath(): string
    {

        $dist = Str::of($this->argument('path'))
            ->replaceMatches('#\{.*}#', '')
            ->replaceMatches('#/{2,}#', '/')
            ->explode('/')
            ->filter()
            ->map(function (string $segment) {
                return Str::of($segment)
                    ->ltrim('/')
                    ->rtrim('/')
                    ->ucfirst();
            });


        $feature = $dist->take(-2)->first();
        $slice = $this->getMethodForFileName();
        $segment = Str::of($feature)->singular()->append($slice);

        $dist->push($slice, $segment);

        return $dist->join(DIRECTORY_SEPARATOR);
    }

    private function getEndpointFullDist(): Stringable
    {
        $dist = Str::of($this->getEndpointDist());
        $configDist = Str::of(config("fast-endpoints.dist"));

        $configDist = $configDist->replace(app_path(), '');
        if (!$dist->startsWith($configDist)) {
            $dist = $dist->prepend($configDist, DIRECTORY_SEPARATOR);
        }

        return $dist->prepend('app');
    }

    private function getMethodForFileName(): string
    {
        $selectedMethod = [];
        foreach (self::METHOD_OPTIONS as $method) {
            $isSelected = $this->option($method);

            if (!$isSelected) {
                continue;
            }

            if ($method === 'any') {
                return 'Any';
            }

            $selectedMethod[] = ucfirst($method);
        }

        if (count($selectedMethod) > 1) {
            return 'Endpoint';
        }

        return $selectedMethod[0] ?? 'Any';
    }

    private function getRequestNamespace(): ?string
    {
        $value = $this->getWithOptionValue('request');
        if (is_bool($value) && $value) {
            return config('fast-endpoints.request');
        }

        return $value;
    }

    private function getResponseNamespace(): ?string
    {
        $value = $this->getWithOptionValue('response');
        if (is_bool($value) && $value) {
            return config('fast-endpoints.response');
        }

        return $value;
    }

    private function getWithOptionValue(string $stringValueKey): bool|string|null
    {
        $value = $this->option($stringValueKey);

        if (!!$value) {
            return $value;
        }

        $boolValueKey = sprintf('with-%s', $stringValueKey);
        $value = $this->option($boolValueKey) ?? false;

        return match ($value) {
            true => true,
            default => null,
        };
    }
}
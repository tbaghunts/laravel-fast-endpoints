<?php

namespace Baghunts\LaravelFastEndpoint\Generator;

use Illuminate\Support\Facades\Pipeline;

use Baghunts\LaravelFastEndpoint\Contracts\{
    RouteGeneratorContract,
    EndpointConfigContract
};
use Baghunts\LaravelFastEndpoint\Generator\Pipes\{
    WherePipe,
    RouteNamePipe,
    WhereUuidPipe,
    WhereUlidPipe,
    WhereAlphaPipe,
    WithTrashedPipe,
    WhereNumberPipe,
    ScopeBindingsPipe,
    RouteDeclarationPipe,
    WhereAlphaNumericPipe
};

class RouteGenerator implements RouteGeneratorContract
{
    private array $statements = [];

    public function __construct(
        private readonly string $classNamespace,
        private readonly EndpointConfigContract $endpointConfig,
    )
    {
    }

    public function getEndpointConfiguration(): EndpointConfigContract
    {
        return $this->endpointConfig;
    }
    public function getEndpointClassNamespace(): string
    {
        return $this->classNamespace;
    }

    public function addStatement(string $statement): self
    {
        $this->statements[] = $statement;
        return $this;
    }

    public function output(): string
    {
        return $this->generateCode();
    }
    protected function generateCode(): string
    {
        Pipeline::send($this)
            ->through([
                RouteDeclarationPipe::class, // Required to be the first

                WherePipe::class,
                RouteNamePipe::class,
                WhereUuidPipe::class,
                WhereUlidPipe::class,
                WhereAlphaPipe::class,
                WhereNumberPipe::class,
                WithTrashedPipe::class,
                ScopeBindingsPipe::class,
                WhereAlphaNumericPipe::class,
            ])->thenReturn();

        return sprintf(
            "%s;",
            implode("->", $this->statements),
        );
    }
}
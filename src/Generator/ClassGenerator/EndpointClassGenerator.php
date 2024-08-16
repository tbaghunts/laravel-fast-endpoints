<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator;

use Arr;
use Str;

use Illuminate\Support\Facades\Pipeline;

use Baghunts\LaravelFastEndpoint\Attributes\Any;
use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator;
use Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator\{
    EndpointClassGeneratorContract
};
use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Pipes\{
    CanPipe,
    NamePipe,
    GuestPipe,
    WhereUlid,
    WhereUuid,
    MethodPipe,
    WhereAlpha,
    WhereNumber,
    DefaultsPipe,
    ThrottlePipe,
    MiddlewarePipe,
    WithTrashedPipe,
    WhereAlphaNumeric,
    ScopeBindingsPipe,
    WithoutThrottlePipe,
    WithoutMiddlewarePipe,
};

use Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Traits\WithRequestGenerator;

class EndpointClassGenerator extends ClassGenerator implements EndpointClassGeneratorContract
{
    use WithRequestGenerator;

    private const string REQUEST_VARIABLE_NAME = 'request';

    private array $options = [];
    private array $attributes = [];
    private ?string $routePath = null;

    protected function getStubName(): string
    {
        return "endpoint";
    }

    protected function getReplaceable(): array
    {
        $this->runPipeline();

        return [
            'RETURN' => $this->getReturnSource(),
            'REQUEST' => $this->getRequestSource(),
            'RESPONSE' => $this->getResponseSource(),
            'ATTRIBUTES' => $this->getAttributesSource(),
            'REQUEST_PARAM' => $this->getRequestParamSource(),
            'METHOD_COMMENT' => $this->getClassCommentSource(),
        ];
    }

    protected function runPipeline()
    {
        return Pipeline::send($this)
            ->through([
                NamePipe::class,
                MethodPipe::class,
                DefaultsPipe::class,

                CanPipe::class,
                GuestPipe::class,
                ThrottlePipe::class,
                MiddlewarePipe::class,
                WithoutThrottlePipe::class,
                WithoutMiddlewarePipe::class,

                WithTrashedPipe::class,
                ScopeBindingsPipe::class,

                WhereUuid::class,
                WhereUlid::class,
                WhereAlpha::class,
                WhereNumber::class,
                WhereAlphaNumeric::class,
            ])->thenReturn();
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function setRoutePath(string $path): self
    {
        $this->routePath = $path;
        return $this;
    }
    
    public function setAttribute(string $name, array|string|null $args = null): self
    {
        $this->attributes[$name] = Arr::wrap($args);
        $this->setImport($this->getAttributesNamespace(), $name);

        return $this;
    }

    private function getAttributesNamespace(): string
    {
        return Str::of(Any::class)
            ->beforeLast('\\')
            ->toString();
    }

    public function getRoutePath(): ?string
    {
        return $this->routePath;
    }

    private function getAttributesSource(): string
    {
        return collect($this->attributes)->map(function (array $args, string $name) {
            return sprintf(
                '#[%s%s]',
                $name,
                $this->generateAttributeArgs($args)
            );
        })->join(PHP_EOL);
    }

    private function generateAttributeArgs(array $args): string
    {
        if (empty($args)) {
            return '';
        }

        $args = collect($args)->map(function ($arg) {
            return $arg;
        })->join(', ');

        return sprintf('(%s)', $args);
    }


    private function getReturnSource(): string
    {
        return $this->getResponseClassName() ?? 'void';
    }

    private function getRequestSource(): string
    {
        $requestName = $this->getRequestClassName();

        if (!$requestName) {
            return '';
        }

        return sprintf('%s %s', $requestName, $this->getRequestVariableName());
    }

    private function getResponseSource(): string
    {
        $responseName = $this->getResponseClassName();

        if (!$responseName) {
            return '// TODO: Implement the request handling logic.';
        }

        return sprintf(
            'return new %s(%s);',
            $responseName,
            sprintf('%s->toArray()', $this->getRequestVariableName()),
        );
    }

    private function getRequestParamSource(): string
    {
        $requestClassName = $this->getRequestClassName();

        if (!$requestClassName) {
            return '';
        }

        return sprintf(
            '@param %s %s',
            $requestClassName,
            $this->getRequestVariableName(),
        );
    }

    private function getClassCommentSource(): string
    {
        $routePath = $this->getRoutePath();

        $value = '.';
        if ($routePath) {
            $value = sprintf(' with path "%s".', $this->getRoutePath());
        }

        return sprintf(
            'Handle the incoming request for the endpoint%s',
            $value
        );
    }

    private function getRequestVariableName(): string
    {
        return sprintf('$%s', self::REQUEST_VARIABLE_NAME);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function loadOptions(array $options): EndpointClassGeneratorContract
    {
        $this->options = $options;
        return $this;
    }

    public function getOption(string $name, $default = null): mixed
    {
        return $this->options[$name] ?? $default;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoint\Generator\ClassGenerator\Traits;

use Str;

trait WithRequestGenerator
{
    private ?string $requestNamespace = null;
    private ?string $responseNamespace = null;

    public function getRequestClassName(): ?string
    {
        return $this->extractClassName($this->requestNamespace);
    }

    public function getRequestNamespace(): ?string
    {
        return $this->requestNamespace;
    }

    public function setRequestNamespace(?string $request): self
    {
        if ($request) {
            $this->setImport(
                $this->requestNamespace = $request
            );
        }

        return $this;
    }

    public function getResponseNamespace(): ?string
    {
        return $this->responseNamespace;
    }

    public function getResponseClassName(): ?string
    {
        return $this->extractClassName(
            $this->responseNamespace
        );
    }

    public function setResponseNamespace(?string $response): self
    {
        if ($response) {
            $this->setImport(
                $this->responseNamespace = $response
            );
        }

        return $this;
    }

    protected function extractClassName(?string $namespace): ?string
    {
        if (!$namespace) {
            return null;
        }

        return Str::of($namespace)
            ->afterLast('\\');
    }
}
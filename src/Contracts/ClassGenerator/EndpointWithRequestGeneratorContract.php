<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\ClassGenerator;

interface EndpointWithRequestGeneratorContract
{
    public function getRequestNamespace(): ?string;
    public function getRequestClassName(): ?string;
    public function getResponseNamespace(): ?string;
    public function getResponseClassName(): ?string;
    public function setRequestNamespace(?string $request): self;
    public function setResponseNamespace(?string $response): self;
}

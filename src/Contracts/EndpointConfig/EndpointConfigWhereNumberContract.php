<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigWhereNumberContract
{
    public function getWhereNumber(): array;
    public function setWhereNumber(array $whereNumber): self;
    public function addWhereNumber(string|array $parameters): self;
}
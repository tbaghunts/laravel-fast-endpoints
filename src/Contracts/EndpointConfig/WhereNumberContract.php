<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface WhereNumberContract
{
    public function getWhereNumber(): array;
    public function setWhereNumber(array $whereNumber): self;
    public function addWhereNumber(string|array $parameters): self;
}
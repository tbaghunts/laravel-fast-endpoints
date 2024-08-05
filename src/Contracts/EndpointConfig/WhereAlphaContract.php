<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WhereAlphaContract
{
    public function getWhereAlpha(): array;
    public function setWhereAlpha(array $whereAlpha): self;
    public function addWhereAlpha(string|array $parameters): self;
}
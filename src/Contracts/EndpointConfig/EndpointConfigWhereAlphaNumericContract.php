<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigWhereAlphaNumericContract
{
    public function getWhereAlphaNumeric(): array;
    public function setWhereAlphaNumeric(array $whereAlphaNumeric): self;
    public function addWhereAlphaNumeric(string|array $parameters): self;
}
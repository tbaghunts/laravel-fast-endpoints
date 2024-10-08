<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface WhereAlphaNumericContract
{
    public function getWhereAlphaNumeric(): array;
    public function setWhereAlphaNumeric(array $whereAlphaNumeric): self;
    public function addWhereAlphaNumeric(string|array $parameters): self;
}
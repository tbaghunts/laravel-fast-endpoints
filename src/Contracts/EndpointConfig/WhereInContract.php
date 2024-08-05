<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WhereInContract
{
    public function getWhereIn(): array;
    public function setWhereIn(array $whereIn): self;
    public function addWhereIn(array|string $parameters, array $values): self;
}
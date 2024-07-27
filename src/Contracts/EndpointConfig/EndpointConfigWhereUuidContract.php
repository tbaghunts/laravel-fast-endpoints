<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigWhereUuidContract
{
    public function getWhereUuid(): array;
    public function setWhereUuid(array $whereUlid): self;
    public function addWhereUuid(string|array $parameters): self;
}
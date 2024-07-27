<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigWhereUlidContract
{
    public function getWhereUlid(): array;
    public function setWhereUlid(array $whereUlid): self;
    public function addWhereUlid(string|array $parameters): self;
}
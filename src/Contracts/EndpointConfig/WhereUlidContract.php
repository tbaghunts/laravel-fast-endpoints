<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface WhereUlidContract
{
    public function getWhereUlid(): array;
    public function setWhereUlid(array $whereUlid): self;
    public function addWhereUlid(string|array $parameters): self;
}
<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface WhereContract
{
    public function getWhere(): array;
    public function setWhere(array $where): self;
    public function addWhere(string|array $name, ?string $expression = null): self;
}
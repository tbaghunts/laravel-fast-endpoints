<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface WhereContract
{
    public function getWhere(): array;
    public function setWhere(array $where): self;
    public function addWhere(string|array $name, ?string $expression = null): self;
}
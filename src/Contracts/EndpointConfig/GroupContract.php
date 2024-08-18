<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

use Illuminate\Support\Collection;

interface GroupContract
{
    public function getGroups(): array;
    public function setGroups(array|string $groups): self;
}
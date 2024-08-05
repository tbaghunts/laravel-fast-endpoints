<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

use Illuminate\Support\Collection;

interface GroupContract
{
    public function getGroups(): array;
    public function setGroups(array|string $groups): self;
}
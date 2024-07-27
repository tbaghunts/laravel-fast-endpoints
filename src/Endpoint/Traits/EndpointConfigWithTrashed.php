<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

use Baghunts\LaravelFastEndpoint\Enums\EnumEndpointMethod;

trait EndpointConfigWithTrashed
{
    public function getWithTrashed(): bool|null
    {
        return $this->withTrashed;
    }

    public function withoutTrashed(): self
    {
        $this->withTrashed = false;
        return $this;
    }

    public function withTrashed(): self
    {
        $this->withTrashed = true;
        return $this;
    }

}
<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait Can
{
    public function getCan(): array
    {
        return $this->can;
    }

    public function setCan(array|string $ability, array|string|null $models = null): self
    {
        if (is_string($ability)) {
            $ability = [
                $ability => $models
            ];
        }

        $this->can = array_merge($this->can, $ability);

        return $this;
    }
}
<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint\Traits;

trait Defaults
{
    public function getDefaults(): array
    {
        return $this->defaults;
    }

    public function setDefaults(array $defaults): self
    {
        $this->defaults = array_merge($this->defaults, $defaults);
        return $this;
    }

    public function addDefault(string $key, $default = null): self
    {
        $this->defaults[$key] = $default;
        return $this;
    }
}
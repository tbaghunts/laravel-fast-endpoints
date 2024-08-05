<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait EndpointConfigMerge
{
    public function mergeCollection(array $configs): self
    {
        foreach ($configs as $config) {
            $this->merge($config);
        }

        return $this;
    }

    public function merge(array $config): self
    {
        foreach ($config as $key => $value) {
            if (!property_exists($this, $key)) {
                continue;
            }

            if (is_array($value)) {
                $this->{$key} = array_merge($this->{$key}, $value);
            } else {
                $this->{$key} = $value;
            }
        }

        return $this;
    }
}
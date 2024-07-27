<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint\Traits;

trait EndpointConfigScopeBindings
{
    public function getScopeBindings(): bool|null
    {
        return $this->scopeBindings;
    }

    public function withoutScopeBindings(): self
    {
        $this->scopeBindings = false;
        return $this;
    }
    public function withScopeBindings(): self
    {
        $this->scopeBindings = true;
        return $this;
    }
    public function setScopeBindings(bool|null $scopeBindings): self
    {
        $this->scopeBindings = $scopeBindings;
        return $this;
    }
}
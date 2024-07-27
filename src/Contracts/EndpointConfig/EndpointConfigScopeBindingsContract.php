<?php

namespace Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig;

interface EndpointConfigScopeBindingsContract
{
    public function withScopeBindings(): self;
    public function withoutScopeBindings(): self;
    public function getScopeBindings(): bool|null;
    public function setScopeBindings(bool|null $scopeBindings): self;
}
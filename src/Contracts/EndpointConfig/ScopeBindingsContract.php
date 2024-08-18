<?php

namespace Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig;

interface ScopeBindingsContract
{
    public function withScopeBindings(): self;
    public function withoutScopeBindings(): self;
    public function getScopeBindings(): bool|null;
    public function setScopeBindings(bool|null $scopeBindings): self;
}
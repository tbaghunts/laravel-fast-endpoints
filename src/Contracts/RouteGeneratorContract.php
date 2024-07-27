<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

interface RouteGeneratorContract
{
    public function output(): string;
    public function getEndpointClassNamespace(): string;
    public function addStatement(string $statement): self;
    public function getEndpointConfiguration(): EndpointConfigContract;
}
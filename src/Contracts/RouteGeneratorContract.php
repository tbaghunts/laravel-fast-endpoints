<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

use Illuminate\Routing\Route;

interface RouteGeneratorContract
{
    public function getRoute(): ?Route;
    public function generate(): ?Route;
    public function getEndpointConfiguration(): EndpointConfigContract;
}
<?php

namespace Baghunts\LaravelFastEndpoints\Contracts;

interface EndpointAttributeContract
{
    public function apply(EndpointConfigContract $endpointConfig);
}
<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

interface EndpointAttributeContract
{
    public function apply(EndpointConfigContract $endpointConfig);
}
<?php

namespace Baghunts\LaravelFastEndpoints\Contracts;

interface EndpointContract
{
    public function getConfiguration(): EndpointConfigContract;
}
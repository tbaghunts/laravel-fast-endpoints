<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

interface EndpointContract
{
    public function getConfiguration(): EndpointConfigContract;
}
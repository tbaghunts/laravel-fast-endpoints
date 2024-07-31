<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

abstract class Endpoint implements EndpointContract
{
    public function __construct(
        protected EndpointConfigContract $config
    )
    {
    }

    public function getConfiguration(): EndpointConfigContract
    {
        return $this->config;
    }
}

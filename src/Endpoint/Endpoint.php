<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint;

use Illuminate\Routing\Controller;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointContract;
use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;

abstract class Endpoint extends Controller implements EndpointContract
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

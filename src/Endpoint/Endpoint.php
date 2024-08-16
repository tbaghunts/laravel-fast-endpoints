<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint;

use Illuminate\Routing\Controller;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointContract;
use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;

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

<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\{
    EndpointConfigWhereContract,
    EndpointConfigMethodContract,
    EndpointConfigWhereInContract,
    EndpointConfigWhereUuidContract,
    EndpointConfigWhereUlidContract,
    EndpointConfigWhereAlphaContract,
    EndpointConfigMiddlewareContract,
    EndpointConfigWithTrashedContract,
    EndpointConfigWhereNumberContract,
    EndpointConfigScopeBindingsContract,
    EndpointConfigWhereAlphaNumericContract,
};

interface EndpointConfigContract extends
    EndpointConfigWhereContract,
    EndpointConfigMethodContract,
    EndpointConfigWhereInContract,
    EndpointConfigWhereUuidContract,
    EndpointConfigWhereUlidContract,
    EndpointConfigWhereAlphaContract,
    EndpointConfigMiddlewareContract,
    EndpointConfigWithTrashedContract,
    EndpointConfigWhereNumberContract,
    EndpointConfigScopeBindingsContract,
    EndpointConfigWhereAlphaNumericContract
{
}

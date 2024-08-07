<?php

namespace Baghunts\LaravelFastEndpoint\Contracts;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfig\{
    CanContract,
    WhereContract,
    GroupContract,
    BlockContract,
    MethodContract,
    WhereInContract,
    DefaultsContract,
    WhereUuidContract,
    WhereUlidContract,
    WhereAlphaContract,
    MiddlewareContract,
    WithTrashedContract,
    WhereNumberContract,
    ScopeBindingsContract,
    WithoutBlockingContract,
    WithoutMiddlewareContract,
    WhereAlphaNumericContract,
    EndpointConfigMergeContract,
};

interface EndpointConfigContract extends
    CanContract,
    WhereContract,
    GroupContract,
    BlockContract,
    MethodContract,
    WhereInContract,
    DefaultsContract,
    WhereUuidContract,
    WhereUlidContract,
    WhereAlphaContract,
    MiddlewareContract,
    WithTrashedContract,
    WhereNumberContract,
    ScopeBindingsContract,
    WithoutBlockingContract,
    WithoutMiddlewareContract,
    WhereAlphaNumericContract,
    EndpointConfigMergeContract
{
}

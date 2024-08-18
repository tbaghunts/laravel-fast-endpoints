<?php

namespace Baghunts\LaravelFastEndpoints\Contracts;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfig\{
    CanContract,
    WhereContract,
    GroupContract,
    MethodContract,
    WhereInContract,
    DefaultsContract,
    ThrottleContract,
    WhereUuidContract,
    WhereUlidContract,
    WhereAlphaContract,
    MiddlewareContract,
    WithTrashedContract,
    WhereNumberContract,
    ScopeBindingsContract,
    WithoutThrottleContract,
    WithoutMiddlewareContract,
    WhereAlphaNumericContract,
    EndpointConfigMergeContract,
};

interface EndpointConfigContract extends
    CanContract,
    WhereContract,
    GroupContract,
    MethodContract,
    WhereInContract,
    DefaultsContract,
    ThrottleContract,
    WhereUuidContract,
    WhereUlidContract,
    WhereAlphaContract,
    MiddlewareContract,
    WithTrashedContract,
    WhereNumberContract,
    ScopeBindingsContract,
    WithoutThrottleContract,
    WithoutMiddlewareContract,
    WhereAlphaNumericContract,
    EndpointConfigMergeContract
{
}

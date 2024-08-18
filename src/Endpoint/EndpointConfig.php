<?php

namespace Baghunts\LaravelFastEndpoints\Endpoint;

use Baghunts\LaravelFastEndpoints\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoints\Endpoint\Traits\{
    Can,
    Where,
    Group,
    Method,
    WhereIn,
    Throttle,
    Defaults,
    WhereUuid,
    WhereUlid,
    Middleware,
    WhereAlpha,
    WhereNumber,
    WithTrashed,
    ScopeBindings,
    WithoutThrottle,
    WithoutMiddleware,
    WhereAlphaNumeric,
    EndpointConfigMerge,
};

class EndpointConfig implements EndpointConfigContract
{
    use Can,
        Where,
        Group,
        Method,
        WhereIn,
        Throttle,
        Defaults,
        WhereUuid,
        WhereUlid,
        WhereAlpha,
        Middleware,
        WithTrashed,
        WhereNumber,
        ScopeBindings,
        WithoutThrottle,
        WithoutMiddleware,
        WhereAlphaNumeric,
        EndpointConfigMerge;

    public function __construct(
        protected array     $can = [],
        protected array     $where = [],
        protected ?string   $path = null,
        protected ?string   $name = null,
        protected array     $groups = [],
        protected array     $method = [],
        protected array     $whereIn = [],
        protected array     $defaults = [],
        protected array     $throttles = [],
        protected array     $whereUuid = [],
        protected array     $whereUlid = [],
        protected array     $middleware = [],
        protected array     $whereAlpha = [],
        protected array     $whereNumber = [],
        protected bool      $withTrashed = false,
        protected ?bool     $scopeBindings = null,
        protected array     $whereAlphaNumeric = [],
        protected array     $withoutMiddleware = [],
    )
    {
    }
}
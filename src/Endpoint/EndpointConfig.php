<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoint\Endpoint\Traits\{
    Can,
    Block,
    Where,
    Group,
    Method,
    WhereIn,
    Defaults,
    Fallback,
    WhereUuid,
    WhereUlid,
    Middleware,
    WhereAlpha,
    WhereNumber,
    WithTrashed,
    WithoutBlocking,
    ScopeBindings,
    WithoutMiddleware,
    WhereAlphaNumeric,
    EndpointConfigMerge,
};

class EndpointConfig implements EndpointConfigContract
{
    use Can,
        Block,
        Where,
        Group,
        Method,
        WhereIn,
        Fallback,
        Defaults,
        WhereUuid,
        WhereUlid,
        WhereAlpha,
        Middleware,
        WithTrashed,
        WhereNumber,
        ScopeBindings,
        WithoutBlocking,
        WithoutMiddleware,
        WhereAlphaNumeric,
        EndpointConfigMerge;

    public function __construct(
        protected array     $can = [],
        protected array     $block = [],
        protected array     $where = [],
        protected ?string   $path = null,
        protected ?string   $name = null,
        protected array     $groups = [],
        protected array     $method = [],
        protected array     $whereIn = [],
        protected array     $defaults = [],
        protected array     $whereUuid = [],
        protected array     $whereUlid = [],
        protected array     $middleware = [],
        protected array     $whereAlpha = [],
        protected array     $whereNumber = [],
        protected bool      $fallback = false,
        protected bool      $withTrashed = false,
        protected bool      $withoutBlock = false,
        protected ?bool     $scopeBindings = null,
        protected array     $whereAlphaNumeric = [],
        protected array     $withoutMiddleware = [],
    )
    {
    }
}
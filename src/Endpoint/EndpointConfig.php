<?php

namespace Baghunts\LaravelFastEndpoint\Endpoint;

use Baghunts\LaravelFastEndpoint\Contracts\EndpointConfigContract;
use Baghunts\LaravelFastEndpoint\Endpoint\Traits\{
    EndpointConfigWhere,
    EndpointConfigMethod,
    EndpointConfigWhereIn,
    EndpointConfigWhereUuid,
    EndpointConfigWhereUlid,
    EndpointConfigMiddleware,
    EndpointConfigWhereAlpha,
    EndpointConfigWhereNumber,
    EndpointConfigWithTrashed,
    EndpointConfigScopeBindings,
    EndpointConfigWhereAlphaNumeric,
};

class EndpointConfig implements EndpointConfigContract
{
    use EndpointConfigWhere,
        EndpointConfigMethod,
        EndpointConfigWhereIn,
        EndpointConfigWhereUuid,
        EndpointConfigWhereUlid,
        EndpointConfigWhereAlpha,
        EndpointConfigMiddleware,
        EndpointConfigWithTrashed,
        EndpointConfigWhereNumber,
        EndpointConfigScopeBindings,
        EndpointConfigWhereAlphaNumeric;

    public function __construct(
        protected array     $where = [],
        protected ?string   $path = null,
        protected ?string   $name = null,
        protected array     $method = [],
        protected array     $whereIn = [],
        protected array     $whereUuid = [],
        protected array     $whereUlid = [],
        protected array     $middleware = [],
        protected array     $whereAlpha = [],
        protected array     $whereNumber = [],
        protected ?bool     $withTrashed = null,
        protected bool|null $scopeBindings = null,
        protected array     $whereAlphaNumeric = [],
    )
    {
    }
}
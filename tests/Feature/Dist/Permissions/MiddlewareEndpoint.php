<?php

namespace Tests\Feature\Dist\Permissions;

use Baghunts\LaravelFastEndpoints\Attributes\Get;
use Baghunts\LaravelFastEndpoints\Attributes\Middleware;
use Baghunts\LaravelFastEndpoints\Attributes\Name;
use Baghunts\LaravelFastEndpoints\Endpoint\Endpoint;
use Tests\Feature\Assets\Middlewares\SecureMiddleware;
use Illuminate\Http\Request;

#[Name("route.with.middleware")]
#[Middleware(SecureMiddleware::class)]
#[Get("/permissions/middleware/{required}/{sometimes?}")]
class MiddlewareEndpoint extends Endpoint
{
    public function __invoke(Request $request): array
    {
        return [
            "method" => $request->getMethod(),
            "data" => [
                "required" => $request->required,
                "sometimes" => $request->sometimes,
            ]
        ];
    }
}